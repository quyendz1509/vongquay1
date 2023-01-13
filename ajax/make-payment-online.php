<?php
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

if (isset($_POST) && $_POST) {

			// Kết thúc check key

	if (isset($_SESSION['id'])) {
		$thongtin = $auth->check_account($_SESSION['id']);

		if ($thongtin) {
			$id = htmlspecialchars($_POST['id']);
				// xử lý code
			$test = $product->makeTransBank($thongtin['id'],$id);
			$status = 0;
			switch ($test) {
				case 0:
				$sms = 'Hệ thống không thể xử lý ngay lúc này';
				break;
				case -876:
				$sms = 'Không thể tìm thấy người dùng.';
				break;
				case -998:
				$sms = 'Mã cũ vẫn chưa được thanh toán. Vui lòng thanh toán trước khi tạo mã mới';
				break;
				case -999:
				$sms = 'Không thể thêm dữ liệu người dùng';
				break;
				case 99:
				$status = 99;

				$sms = 'Tạo mã nạp thành công. Tự động tải lại trang';
				break;
				default:
				$sms = 'Không thể thực hiện hành động';
				break;
			}
			$error = array('status' => $status, 'messages' => $sms);

		}else{
			$error = array('status' => 0, 'messages' => 'Không tìm thấy tài khoản của bạn.');
		}


	}else{
		$error = array('status' => 0, 'messages' => 'Bạn chưa đăng nhập. Vui lòng đăng nhập tài khoản.');
	}

// check key


}

if (isset($error)) {
	print_r(json_encode($error));
}


?>