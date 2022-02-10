<?php
defined('BASEPATH') or exit('No direct script access allowed');

class P24_lib
{
	private $CI;

	public function __construct()
	{
		$this->CI = &get_instance();
		$this->CI->load->helper('p24_helper');
	}

	public function p24_payment($transaction_id)
	{
		require_once 'application/libraries/Przelewy24.php';

		$_POST = p24($_POST, $_SESSION, false, $transaction_id);

		$test = ($_POST["env"] == 1 ? "1" : "0");
		$salt = $_POST["salt"];

		$P24 = new Przelewy24($_POST["p24_merchant_id"], $_POST["p24_pos_id"], $salt, $test);

		log_message('info', json_encode($_POST));

		foreach ($_POST as $k => $v) {
			if (strpos($k, 'p24_') !== false || in_array($k, ['salt'])) $P24->addValue($k, $v);
		}

		$this->CI->back_m->update('transaction', ['p24_data' => json_encode($P24->postData)], $transaction_id);

		$now = date('Y-m-d-H-m-s');
		if (!is_dir('p24/')) {
			mkdir('./p24/', 0777, TRUE);
		}
		file_put_contents("p24/parametry" . $now . ".txt", "p24_crc=" . $_POST['salt'] . "&p24_amount=" . $_POST['p24_amount'] . "&p24_currency=" . $_POST['p24_currency'] . "&env=" . $test);

		$bool = ($_POST["redirect"] == "on") ? true : false;
		$res = $P24->trnRegister($bool);


		if ($res["error"] == '0') {
			$_POST['token'] = $res['token'];
			$_POST['p24_amount'] = $_POST['p24_amount'];
			$_POST['p24_currency'] = $_POST['p24_currency'];
			// $avaliable_transaction = $this->back_m->get_one_where('transaction', $_POST['token'], 'token');
			// if(empty($avaliable_transaction)) {
			// 	addTransaction($_POST);
			// }
			$now = date('Y-m-d-H-m-s');
			if (!is_dir('p24/statuses/')) {
				mkdir('./p24/statuses/', 0777, TRUE);
			}
			file_put_contents("p24/statuses/status" . $now . ".txt", json_encode($res));
			return $P24->getHost() . "trnRequest/" . $res["token"];
		} else {
			$now = date('Y-m-d-H-m-s');
			if (!is_dir('p24/errors/')) {
				mkdir('./p24/errors/', 0777, TRUE);
			}
			echo json_encode($res);
			file_put_contents("p24/errors/error" . $now . ".txt", json_encode($res));
			exit;
		}
	}
}