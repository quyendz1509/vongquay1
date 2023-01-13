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
	// xử lý
			$code = htmlspecialchars($_POST['code']);
			$gift_info = $product->getInfoGiftcode($code);
			$time = date('Y-m-d', time());
         
			if ($code == '') {
				// code...
				$error = array('status' => 0, 'messages' => 'Không bỏ trống thông tin');

			}else if(!$gift_info){
				$error = array('status' => 0, 'messages' => 'Giftcode bị từ chối!');

			}else{
				if($gift_info['time'] != $time){
					$error = array('status' => 0, 'messages' => 'Giftcode này đã hết hạn sử dụng.');
				}
				else if($product->checkGiftCode($code,$thongtin['id'],$time)){
					$error = array('status' => 0, 'messages' => 'Bạn đã nhận thưởng giftcode hôm nay.');
				}else if($product->checkGiftCodeAll($thongtin['id'],$time)){
				    $error = array('status' => 0, 'messages' => 'Bạn đã nhận thưởng hôm nay.');
				}
				else{
					$product-> congTienGift($thongtin['id'],$gift_info['price'],$time,$code);
					$error = array('status' => 99, 'messages' => 'Bạn đã nhận được <strong>'.number_format($gift_info['price']).'</strong> vnđ.');
				}
			}
		}else{
			$error = array('status' => 0, 'messages' => 'Không tìm thấy tài khoản của bạn.');
		}
	}else{
		$error = array('status' => 0, 'messages' => 'Bạn chưa đăng nhập. Vui lòng đăng nhập tài khoản.');
	}
}

if (isset($error)) {
	print_r(json_encode($error));
}


?>