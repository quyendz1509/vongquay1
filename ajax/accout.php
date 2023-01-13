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
			$sanpham = htmlspecialchars($_POST['sanpham']);
			if (!isset($sanpham)) {
			// code...
				$error  = array('status' => 0, 'messages' => 'Không tìm thấy sản phẩm.');
			}else{
				$info = $product->getInfoProducts($sanpham);
				if (!$info) {
					$error = array('status' => 0, 'messages' => 'không tìm thấy sản phẩm hoặc đã được mua bởi người khác.');
				}else{
					if($info['price'] > $thongtin['coin'] ) {
						$error = array('status' => 0, 'messages' => 'Số dư của bạn không đủ. Vui lòng nạp thêm: '.number_format($info['price'] - $thongtin['coin'] ).' vnđ' );
					}else{
						$buy_day = date('Y-m-d', time());
						$product->addHistory($sanpham,$thongtin['id'],$info['taikhoan'],$info['password'],$info['price'],$info['info'],$info['level'],$info['skin'],$info['ranks'],$info['champs'],$info['cate_id'],$buy_day);
						$error = array('status' => 99, 'messages' => 'Mua hàng thành công ! Truy cập vào lịch sử giao dịch để xem thông tin.');
					}

				}
			}
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