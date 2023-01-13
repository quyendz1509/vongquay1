<?php
session_start();
// set time zone
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Gọi public
require '../modules/public.php';
// Gọi database
require '../modules/database.php';

// gọi auth 
require '../modules/function.php';

$auth = new func();

if (isset($_POST) && $_POST) {

			// Kết thúc check key

	if (isset($_SESSION['id'])) {
		$thongtin = $auth->check_account($_SESSION['id']);

		if ($thongtin) {
			$loaithe = htmlspecialchars($_POST['nhamang']);
			$serial = htmlspecialchars(trim($_POST['serial']));
			$pin = htmlspecialchars(trim($_POST['pin']));
			$menhgia = htmlspecialchars($_POST['menhgia']);
			$request_id = rand(100000000, 999999999);

			if ($loaithe == '' || $serial == '' || $pin == '' || $menhgia == '') {
				// 
				$error = array('status' => 0, 'messages' => 'Không được bỏ trống thông tin.');

			}else if(strlen($serial) < 10){
				$error = array('status' => 0, 'messages' => 'Số serial không hợp lệ.');

			}else if(strlen($pin) < 10){
				$error = array('status' => 0, 'messages' => 'Mã thẻ không hợp lệ.');

			}else if($auth->checkMaThe($pin)){
				$error = array('status' => 0, 'messages' => 'Thẻ đã tồn tại trên hệ thống. Vui lòng chờ duyệt.');
			}else{
				switch ($loaithe) {
					case 'VIETTEL':
					$type_send = 1;
					break;
					case 'VINAPHONE':
					$type_send = 3;
					break;
					case 'MOBIFONE':
					$type_send = 2;
					break;
					default:
					$type_send = 1;
					break;
				}
				$key_bimat = md5($secrect_key.$pin.$serial);
				$url = 'http://gomthe.com/home/api_nap_cham/1280/'.$serial.'/'.$pin.'/'.$type_send.'/'.$menhgia.'/'.$key_bimat;
				$curl_the = $auth->curl_napthe($url);
				$res = json_decode($curl_the);
				if ($res == 404 ) {
                	$error = array('status' => 0, 'messages' => 'Lỗi chưa rõ');
				}else if ($res == 0 ) {
	            $error = array('status' => 0, 'messages' => 'Thẻ đang chờ duyệt');
				}else if ($res == 1 ) {
	            $error = array('status' => 0, 'messages' => 'Thẻ đã duyệt thành công trước đây');
				}else if ($res == 3 ) {
	            $error = array('status' => 0, 'messages' => 'Thẻ đã bị từ chối trước đây');
				}else if ($res == 135 ) {
	            $error = array('status' => 0, 'messages' => 'Lỗi khi gửi mã Viettel không phải 13 hoặc 15 kí tự, mã VT luôn 13 hoặc 15 kí tự');
				}
				else if($res == 10){
				    $time = date('Y-m-d', time());
					$auth->addTheCao($serial,$pin,$menhgia,$loaithe,$_SESSION['id'],$request_id,'Đang xử lý...',$time,'thecao');
					$error = array('status' => 99, 'messages' => 'Gửi thẻ lên hệ thống thành công. Vui lòng chờ duyệt.');
				
				}else{
	
				    $error = array('status' => 0, 'messages' => 'Lỗi không mong muốn. Vui lòng liên hệ admin.');
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