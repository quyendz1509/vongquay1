<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
// set time zone
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Gọi database
require '../modules/database.php';
// Gọi product
require '../modules/product.php';
// gọi auth 
require '../modules/function.php';
$product = new productClass();

$auth = new func();

if (isset($_GET) && $_GET) {

			// Kết thúc check key
	$data = array();
	if (isset($_SESSION['id'])) {
		$thongtin = $auth->check_account($_SESSION['id']);

		if ($thongtin) {
				// xử lý code
			$hisList = $product->getHisAutoList($thongtin['id']);
			foreach ($hisList as $key => $value) {
				// id
				$data['data'][$key]->id = $key;
				//bank
				$brand = $auth->getInfoBankSupportByBrand( $value['brand'] );
				$data['data'][$key]->banks = $brand['name_bank'];
				// mã giao dịch
				$data['data'][$key]->idtrans = '<span class="text-uppercase badge bg-primary">'.$value['trans_id'].'</span>';
				// mệnh giá
				$data['data'][$key]->price .= '<span class="badge bg-success">';
				$data['data'][$key]->price .= number_format($value['amount']).' đ';
				$data['data'][$key]->price .= '</span>';
				$stt = ( $value['status']  == 0) ? '<span class="badge bg-danger">Chưa phát sinh giao dịch </span>' : '<span class="badge bg-success">Đã xử lý </span>' ;
				$data['data'][$key]->stt = $stt;
				$data['data'][$key]->date = $value['time_create'];
			}
		}

	}else{
		$error = array('status' => 0, 'messages' => 'Bạn chưa đăng nhập. Vui lòng đăng nhập tài khoản.');
	}

// check key


}

if (isset($data)) {
	print_r(json_encode($data));
}


?>