<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Expense_income extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('shop_m');
	}


	public function index()
	{
		if (checkAccess()) {
			if (!$this->db->table_exists($this->uri->segment(2))) {
				$this->base_m->create_table($this->uri->segment(2));
			}
			// DEFAULT DATA
			$data = loadDefaultData();

			$data['products'] = $this->back_m->get_with_limit('products', 15);

			echo loadSubViewsBack($this->uri->segment(2), 'index', $data);
		} else {
			redirect('panel');
		}
	}

	public function action($type)
	{
		if (checkAccess()) {
			try {

				$product_qty = $this->shop_m->get_variant_by_sku('variants', $_POST['sku'])->qty;

				if ($type == 'add') {
					$variant['qty'] = $product_qty + $_POST['qty'];
					$this->shop_m->update_variant('variants', $variant, $_POST['sku']);
					$this->session->set_flashdata('flashdata', $message = 'Rekord został zaktualizowany!');
				} else {
					$variant['qty'] = $product_qty - $_POST['qty'];
					if ($variant['qty'] < 0) {
						$variant['qty'] = 0;
					}
					$this->shop_m->update_variant('variants', $variant, $_POST['sku']);
					$this->session->set_flashdata('flashdata', $message = 'Rekord został zaktualizowany!');
				}

				echo json_encode([
					'message' => $message ?? 'SUCCESS',
					'code' => 200,
					'status' =>  true
				]);
			} catch (Error $e) {
				echo json_encode([
					'message' => $e->getMessage(),
					'code' => $e->getCode(),
					'status' => false
				]);
			} catch (Exception $e) {
				echo json_encode([
					'message' => $e->getMessage(),
					'code' => $e->getCode(),
					'status' => false
				]);
			}
		}
	}
}
