<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('shop_m');
	}

	public function index($paging = '')
	{
		if (checkAccess()) {
			if (!$this->db->table_exists($this->uri->segment(2))) {
				$this->base_m->create_table($this->uri->segment(2));
			}
			// DEFAULT DATA
			$data = loadDefaultData();


			$this->load->model('products_m');

			if ($paging < 0) {
				$paging = 0;
			}
			$data['count'] = $this->back_m->get_panel_products();
			$paging = $this->uri->segment(4);
			$perPage = $_COOKIE['panelProductsCount'] ?? 10;
			$data['rows'] = $this->back_m->get_paging('products', $perPage, $paging);
			$this->load->library('pagination');
			$config['base_url'] = base_url('panel/products/index');
			$config['total_rows'] = count($data['count']);
			$config['per_page'] = $perPage;
			$config['next_link'] = '<i class="fas fa-angle-right"></i>';
			$config['prev_link'] = '<i class="fas fa-angle-left"></i>';
			$config['first_link'] = '<i class="fas fa-angle-double-left"></i>';
			$config['last_link'] = '<i class="fas fa-angle-double-right"></i>';
			$this->pagination->initialize($config);
			echo loadSubViewsBack($this->uri->segment(2), 'index', $data);
		} else {
			redirect('panel');
		}
	}

	public function form($type, $id = '')
	{
		if (checkAccess()) {
			// DEFAULT DATA
			$this->load->helper('products');
			$data = loadDefaultData();
			$data['categories'] = $this->back_m->get_all('categories');
			$data['subcategories'] = $this->back_m->get_all('subcategory');
			$data['colors'] = prepare_filter_list('color', $id);
			$data['sizes'] = prepare_filter_list('size', $id);
			$data['standards'] = prepare_filter_list('standard', $id);
			$data['producers'] = prepare_filter_list('producer', $id);
			$data['industries'] = prepare_filter_list('industry', $id);
			$data['producer'] = get_producer_filter($id);


			if ($id != '') {
				$data['value'] = $this->back_m->get_one($this->uri->segment(2), $id);
				$data['products'] = array_merge($this->back_m->get_where_in('products', 'id', explode(',', $data['value']->linked_products)), $this->back_m->get_random('products', 15));
				$data['variant'] = $this->shop_m->variant('variants', $id);
				$data['opinions'] = $this->shop_m->get_opinions('opinions', $id);
				$data['avg_grade'] = $this->back_m->average_users_opinions('opinions', $id);
				$data['num_grades'] = $this->back_m->count_product_opinions('opinions', $id);
			}
			$this->load->helper('products');

			echo loadSubViewsBack($this->uri->segment(2), 'form', $data);
		} else {
			redirect('panel');
		}
	}

	public function action($type, $table, $id = '')
	{
		if (checkAccess()) {



			$now = date('Y-m-d');
			if (!is_dir('uploads/' . $now)) {
				mkdir('./uploads/' . $now, 0777, TRUE);
			}
			$config['upload_path'] = './uploads/' . $now;
			$config['allowed_types'] = '*';
			$config['max_size'] = 0;
			$config['max_width'] = 0;
			$config['max_height'] = 0;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			foreach ($_POST as $key => $value) {

				if (!$this->db->field_exists($key, $table)) {
					$this->base_m->create_column($table, $key);
				}

				if ($key == 'qty_old') {
					send_change_to_await_list($id);
				}

				if ($key == 'name_photo_1') {
					if ($this->upload->do_upload('photo_1')) {
						$data = $this->upload->data();
						$insert['photo'] = $now . '/' . $data['file_name'];
						if ($data['file_type'] != 'image/svg' && isOnWebp()) {

							//WebP Converter
							$photoWebP = convertImageToWebP($insert['photo']);
							$keyFieldPhotoWebP = 'photo_webp';
							if ($photoWebP[0] == true) {
								$insert[$keyFieldPhotoWebP] = $now . '/' . $photoWebP[1];
								createWebPField($table, $keyFieldPhotoWebP);
							} else {
								$this->session->set_flashdata('flashdata', 'Zdjęcie nie zostało poprawnie zoptymalizowane!');
							}
							//WebP Converter

						}
						addMedia($data);
					} elseif ($value == 'usunięte') {
						$insert['photo'] = '';
					}
				} elseif (is_array($value)) {
					$explode = '';
					foreach ($value as $v) {
						$explode .= $v . ',';
					}
					$insert[$key] = rtrim($explode, ",");
				} else {
					if ($key != 'qty' && $key != 'sku' && $key != 'qty_old') {
						$insert[$key] = $value;
					}
				}
			}



			if (!isset($insert['active'])) {
				$insert['active'] = 0;
			}
			if (!isset($insert['awarded'])) {
				$insert['awarded'] = 0;
			}
			if (!isset($insert['special_order'])) {
				$insert['special_order'] = 0;
			}
			if (!isset($insert['one_in_cart'])) {
				$insert['one_in_cart'] = 0;
			}
			if (!isset($insert['opinions'])) {
				$insert['opinions'] = 0;
			}
			if (!isset($insert['news'])) {
				$insert['news'] = 0;
			}
			if (!isset($insert['bestseller'])) {
				$insert['bestseller'] = 0;
			}
			if (!isset($insert['promo_active'])) {
				$insert['promo_active'] = '';
				$insert['promo_discount'] = '';
				$insert['promo_start'] = '';
				$insert['promo_end'] = '';
			}

			$insert['updated'] = date('Y-m-d H:i:s');
			$variant['updated'] = date('Y-m-d H:i:s');
			$insert['outlet'] = isset($_POST['outlet']) ? 1 : 0;

			if ($type == 'insert') {
				$this->back_m->insert($table, $insert);
				$last_id = $this->db->insert_id();
				$variant['product_id'] = $last_id;
				$variant['sku'] = $last_id . '-' . $last_id;
				$variant['qty'] = 0;
				$this->back_m->insert('variants', $variant);
				$this->session->set_flashdata('flashdata', 'Rekord został dodany!');
			} else {
				$variant_record = $this->back_m->get_where('variants', 'product_id', $id);
				if ($variant_record->qty == 0 && $_POST['qty'] != 0) {
					$this->load->helper('product_reminder');
					send_product_reminder($id);
				}
				$variant['qty'] = $_POST['qty'];
				$last_id = $id;
				$this->back_m->update('variants', $variant, $variant_record->id);
				$this->back_m->update($table, $insert, $id);
				$this->session->set_flashdata('flashdata', 'Rekord został zaktualizowany!');
			}

			$this->load->helper('products');
			set_product_categories($_POST['category'], $last_id);
			if (isset($_POST['filter_list'])) set_filter_list($_POST['filter_list'], $last_id);
			if ($_POST['producer'] ?? false) set_producer($_POST['producer'], $last_id);

			redirect($type == 'insert' ? 'panel/' . $table . '/form/update/' . $variant['product_id'] : $_SERVER['HTTP_REFERER']);
		} else {
			redirect('panel');
		}
	}

	public function active()
	{
		$insert['active'] = $_POST['value'];
		$this->back_m->update($_POST['table'], $insert, $_POST['id']);
	}

	public function active_opinion()
	{
		$insert['active'] = $_POST['value'];
		$this->back_m->update($_POST['table'], $insert, $_POST['id']);
	}

	public function render_products($like)
	{
		if (checkAccess()) {
			$data['rows'] = $this->back_m->get_like('products', 'name', urldecode($like), $limit = 15);
			$this->load->view('back/elements/render_products', $data);
		} else {
			redirect('panel');
		}
	}

	public function delete($product_id)
	{
		$this->back_m->delete('products', $product_id);
		$this->back_m->delete('variants', $this->back_m->get_where_array('variants', ['product_id' => $product_id])->id);
		$this->session->set_flashdata('flashdata', 'Rekord został usunięty!');
		redirect('panel/products');
	}
}