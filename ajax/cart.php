<?php 
session_start();
// set time zone
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Gọi database
require '../modules/database.php';
// Gọi product
require '../modules/product.php';

require '../modules/function.php';

$product = new productClass();

$func = new func();

if (isset($_POST) && $_POST) {
	if (isset($_SESSION['id'])) {

		if (!$func->check_account($_SESSION['id'])) {
			// code...
			$error = array('status' => 0, 'messages' => 'Không tìm thấy người dùng.');
		}else{
			$thongtin = $func->check_account($_SESSION['id']);
			$key = htmlspecialchars($_POST['key']);
			if ($key == 0) {
				$id = htmlspecialchars($_POST['id']);
				if (!isset($id)) {
			// code...
					$error  = array('status' => 0, 'messages' => 'Không tìm thấy id' );
				}else{
					$info = $product->cartInfoID($id,$_SESSION['id']);
					if (!$info) {
				// code...
						$error = array('status' => 0, 'messages' => 'không tìm thấy sản phẩm trong giỏ hàng của bạn.');
					}else{
						$product->delete_product_by_user($id,$_SESSION['id']);
						$error = array('status' => 99, 'messages' => 'Đã xóa sản phẩm ra khỏi giỏ hàng của bạn.');

					}
				}
			}else if($key == 1){
				$cartInfo = $product->getInfoCartsByUser($_SESSION['id']);
				if (!$cartInfo) {
					$error = array('status' => 0, 'messages' => 'Giỏ hàng của bạn đang trống.');
				}else{
					$sanpham = '';
					$sotien = 0;
					foreach ($cartInfo as $key => $value) {
						$sanpham .= ' #'.$value['products_id'];
						$sotien += $value['price'];
					}
					$error = array('status' => 999, 'messages' => 'Bạn có muốn thanh toán: '.count($cartInfo).' sản phẩm ? <br> Bao gồm các sản phẩm: '.$sanpham.'<br> Giá tiền: '.number_format($sotien).' VNĐ');
				}

			}else if($key == 2){
				$cartInfo = $product->getInfoCartsByUser($_SESSION['id']);
				if ($product->sumPriceCarts($_SESSION['id']) > $thongtin['coin']) {
					$error = array('status' => 0, 'messages' => 'Số dư của bạn không đủ. Vui lòng nạp thêm.');
				}else{
						$buy_day = date('Y-m-d', time());
					foreach ($cartInfo as $key => $value) {
						$product->addHistory($value['products_id'],$value['user_cart'],$value['taikhoan'],$value['password'],$value['price'],$value['images'],$value['info'],$value['level'],$value['skins'],$value['ranks'],$value['champs'],$value['cate_id'],$buy_day);
					}
					$error = array('status' => 99, 'messages' => 'Thanh toán thành công. Đang chuyển hướng đến lịch sử giao dịch.');
				}
			}
		}

	}else{
		$error = array('status' => 0, 'messages' => 'Cốc cốc ai dẩy ? Đăng nhập đi nè.');
	}
}

if (isset($error)) {
	print_r(json_encode($error));
}


?>