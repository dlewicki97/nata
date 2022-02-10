<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shop extends CI_Controller
{

	private $productsPerPage = 16;

	function __construct()
	{
		parent::__construct();
		$this->load->model('shop_m');
		$this->load->helper('pagination');
		$this->load->helper('filters');
		$this->load->helper('filters_cookie');
		$this->load->helper('products/sort_uri');
		$this->load->helper('photos/is_photo_exists');
		$this->load->helper('listing/categories/remove_subcategory_prefix');
	}

	public function delete_duplicates()
	{
		$products = [];
		$query = $this->db->select('product_id, COUNT(*)')->from('products')->group_by('product_id')->having("COUNT(*) > 1")->get()->result();

		var_dump($query);
		// die;
		// for ($i = 0; $i < count($query); $i++) {
		// 	$row = $query[$i];
		// 	$row_products = $this->back_m->get_where_result('products', ['product_id' => $row->product_id]);
		// 	$this->back_m->delete('products', max($row_products[0]->id, $row_products[1]->id));
		// }
	}

	public function listing($page = 0)
	{

		if (isset($_COOKIE['search'])) {
			$compareFilter = $this->back_m->get_like_one('filter_lists', 'title', $_COOKIE['search']);
			if (!empty($compareFilter)) {
				$_POST['filters'] = $compareFilter->id;
				if (strpos($filters = $_POST['filters'], 'null') === FALSE) setcookie('filters', implode(',', array_unique(explode(',', $filters))), time() + (86400 * 30), "/");
				unset($_COOKIE['search']);
				setcookie('search', null, -1, '/');
				//$this->filters();
				//print_r($_COOKIE);
			}
		}

		$this->load->helper('listing/categories/group_categories_by_dimension');
		$this->load->helper('listing/categories/show_collapse/show_collapse');
		$this->load->helper('listing/categories/filter_categories_by_parent_id');

		$data = loadDefaultDataFront();


		$data['categories'] = group_categories_by_dimension($this->back_m->get_all_priority('categories', 1));

		$data['filters'] = $this->back_m->get_all('filters');

		$data['filter_lists'] = load_filter_lists($data['filters'], $this->uri->segment(2) == 'kategoria' ? $this->uri->segment(4) : null);

		$data['products_desc'] = $this->back_m->get_one('products_desc', 1);

		if (isset($_COOKIE['categoryChange']) || isset($_COOKIE['productShow'])) {
			unset($_COOKIE['categoryChange']);
			unset($_COOKIE['filters']);
			unset($_COOKIE['productShow']);
			unset($_COOKIE['search']);
			setcookie('categoryChange', null, -1, '/');
			setcookie('filters', null, -1, '/');
			setcookie('productShow', null, -1, '/');
			setcookie('search', null, -1, '/');
		}


		echo loadViewsFront('listing', $data);
	}

	public function render_listing($page = 0)
	{
		$data['max_price'] = $this->shop_m->max_price('products');
		$data['count_products'] = $this->shop_m->count_all_results('products');
		$data['filters_cookie'] = get_filters_cookie() ?? [];
		$data['products_desc'] = $this->back_m->get_one('products_desc', 1);

		$perPage = $_COOKIE['perPage'] ?? $this->productsPerPage;
		$data['rows'] = $this->shop_m->get_orderBy_pagging('products', $perPage, $page);

		paginate($data['rows'], $perPage, $data['count_products'], 'sklep');
		$this->load->view('front/elements/render_listing', $data);
	}

	public function product($slug, $id)
	{

		$this->load->helper('products/get_product_variants');
		$this->load->helper('products');
		$this->load->model('products_categories_m');

		unset($_COOKIE['productShow']);
		unset($_COOKIE['search']);
		setcookie('productShow', null, -1, '/');
		setcookie('search', null, -1, '/');


		$this->addLastWatchedProduct($id);

		$data = loadDefaultDataFront();
		$data['product'] = $this->back_m->get_one('products', $id);
		$string = trim($data['product']->description);
		$title = array_slice(explode('- ', $string), 0, 1)[0];
		$list_elements = array_slice(explode('- ', $string), 1);
		if (($compareDesc = ($title . implode('', $list_elements))) == strip_tags($compareDesc)) {

			$description = "$title<br><ul>";
			foreach ($list_elements as $el) {
				$description .= "<li>$el</li>";
			}
			$description .= "</ul>";
			$data['product']->description = $description;
		}


		$data['variants'] = get_product_variants($data['product']);

		$data['avg_grade'] = $this->back_m->average_users_opinions('opinions', $id);
		$data['num_grades'] = $this->back_m->count_product_opinions('opinions', $id);

		$producer = get_producer_filter($data['product']->id);
		$data['producer'] = $this->back_m->get_one('filter_lists', $producer ? $producer->filter_list_id : 0);

		$data['meta_title'] = $data['product']->title_seo ? $data['product']->title_seo : $data['product']->name;
		$data['meta_desciption'] = $data['product']->description_seo;

		$data['products_desc'] = $this->back_m->get_one('products_desc', 1);
		$data['categories'] = $this->products_categories_m->get_joined_categories($id);
		$data['product_variant'] = $this->shop_m->variant('variants', $data['product']->id);

		$data['linked_products'] = array_reduce(array_filter(explode(',', $data['product']->linked_products), function ($product_id) {
			return $product_id;
		}), function ($total, $product_id) {
			return array_merge($total, [$this->back_m->get_one('products', $product_id)]);
		}, []);

		$data['grade_5'] = $this->back_m->count_users_opinions('opinions', '5', $data['product']->id);
		$data['grade_4'] = $this->back_m->count_users_opinions('opinions', '4', $data['product']->id);
		$data['grade_3'] = $this->back_m->count_users_opinions('opinions', '3', $data['product']->id);
		$data['grade_2'] = $this->back_m->count_users_opinions('opinions', '2', $data['product']->id);
		$data['grade_1'] = $this->back_m->count_users_opinions('opinions', '1', $data['product']->id);

		// $data['grades_count']

		$data['product_opinions'] = array_reverse($this->back_m->get_product_opinions('opinions', $data['product']->id));
		$data['user_opinions'] = $this->back_m->get_user_opinion_for_product('opinions', $_SESSION['id'] ?? null, $data['product']->id);

		$data['last_watched_products'] = array_reduce(array_reverse(json_decode($_COOKIE['lastWatchedProduct'] ?? "[]")), function ($total, $product_id) {
			return array_merge($total, [$this->back_m->get_one('products', $product_id)]);
		}, []);

		$this->load->model('products_filter_lists_m');

		$data['filters'] = $this->back_m->get_all('filters');
		$products_filters = $this->products_filter_lists_m->get_by_products_ids([$id]);
		foreach ($data['filters'] as $filter) {
			$data['products_filters'][$filter->id] = array_filter($products_filters, function ($products_filter) use ($filter) {
				return $products_filter->filter_id == $filter->id;
			});
		}


		echo loadViewsFront('product', $data);
	}

	public function render_category_listing($id, $page = 0)
	{

		$data['max_price'] = $this->shop_m->max_price('products');
		$data['count_products'] = $this->shop_m->count_category_products($id);
		$data['filters_cookie'] = get_filters_cookie() ?? [];
		$data['products_desc'] = $this->back_m->get_one('products_desc', 1);
		$category = $this->back_m->get_one('categories', $id);

		$perPage = $_COOKIE['perPage'] ?? $this->productsPerPage;
		$data['rows'] = $this->shop_m->get_pagination_category($id, $perPage, $page);

		paginate($data['rows'], $perPage, $data['count_products'], "sklep/kategoria/$category->slug/$id");

		$this->load->view('front/elements/render_listing', $data);
	}

	public function render_news_listing($page = 0)
	{

		$data['max_price'] = $this->shop_m->max_price('products');
		$data['count_products'] = $this->shop_m->count_news_products();
		$data['filters_cookie'] = get_filters_cookie() ?? [];
		$data['products_desc'] = $this->back_m->get_one('products_desc', 1);

		$perPage = $_COOKIE['perPage'] ?? $this->productsPerPage;
		$data['rows'] = $this->shop_m->get_pagination_news($perPage, $page);

		paginate($data['rows'], $perPage, $data['count_products'], "nowosci");


		$this->load->view('front/elements/render_listing', $data);
	}

	public function render_outlet_listing($page = 0)
	{

		$data['max_price'] = $this->shop_m->max_price('products');
		$data['count_products'] = $this->shop_m->count_outlet_products();
		$data['filters_cookie'] = get_filters_cookie() ?? [];
		$data['products_desc'] = $this->back_m->get_one('products_desc', 1);

		$perPage = $_COOKIE['perPage'] ?? $this->productsPerPage;
		$data['rows'] = $this->shop_m->get_pagination_outlet($perPage, $page);

		paginate($data['rows'], $perPage, $data['count_products'], "outlet");


		$this->load->view('front/elements/render_listing', $data);
	}



	public function filters()
	{
		if (strpos($filters = $_POST['filters'], 'null') === FALSE) setcookie('filters', implode(',', array_unique(explode(',', $filters))), time() + (86400 * 30), "/");

		$referer = explode('/', str_replace(base_url(), '', $_SERVER['HTTP_REFERER']));

		redirect(@$referer[1] == 'kategoria' ? "sklep/kategoria/{$referer[2]}/{$referer[3]}" : 'sklep');
	}

	public function addLastWatchedProduct($id)
	{
		if (isset($_COOKIE['lastWatchedProduct'])) {
			$products = json_decode($_COOKIE['lastWatchedProduct'], true);
			if (!in_array($id, $products)) {
				array_push($products, $id);
			}
		} else {
			$products = array(
				0 => $id
			);
		}
		setcookie('lastWatchedProduct', json_encode($products), time() + (86400 * 30), "/");
	}

	public function sendOpinion()
	{

		$insert['user_id'] = $_SESSION['id'];
		$insert['name'] = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
		$insert['grade'] = $_POST['grade'];
		$insert['message'] = $_POST['message'];
		$insert['product_id'] = $_POST['product_id'];

		$this->session->set_flashdata('flashdata_true', '<p class="text-success font-weight-bold mb-0">Pomyślnie dodałeś opinie</p>');
		$this->back_m->insert('opinions', $insert);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function removeSearchValue()
	{
		unset($_COOKIE['search']);
		setcookie('search', null, -1, '/');
		redirect($_SERVER['HTTP_REFERER']);
	}
}