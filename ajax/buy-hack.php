<?php
session_start();
// set time zone
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Gọi public
require '../modules/public.php';

// Gọi database
require '../modules/database.php';

// gọi auth 
require '../modules/hack.php';

$hack = new hackClass();

if (isset($_POST) && $_POST) {

			// Kết thúc check key

	if (isset($_SESSION['id'])) {
		$thongtin = $hack->check_account($_SESSION['id']);

		if ($thongtin) {

			$key = htmlspecialchars(trim($_POST['key']));
			if (!isset($key)) {
				$error  = array('status' => 0, 'messages' => 'Bad Request.');
			}else{
				// pack id from client
				if ($key == 0) {
					$pack_id = htmlspecialchars(trim($_POST['pack_id']));
					$soluong = htmlspecialchars(trim($_POST['soluong']));
					if ($soluong < 1 ) {
						$error = array('status' => 0, 'messages' => 'Số lượng ít nhất là 1.' );
					}else if (!$hack->getPackHack($pack_id)) {
						$error  = array('status' => 0, 'messages' => 'Không tìm thấy gói hack.');
					}else if(!$hack->getListKeyByPackHack($pack_id)){
						$error  = array('status' => 0, 'messages' => 'Không tìm thấy key hack cho gói hack này.');
					}else if( count($hack->getListKeyByPackHack($pack_id)) < $soluong ){
						$error  = array('status' => 0, 'messages' => 'Số lượng key không đủ');
					}else{
						$info_pack = $hack->getPackHack($pack_id);
						$inf_hack = $hack->getInfoHack($info_pack['hack_id']);
						$giatien = $soluong*$info_pack['price'];
						if ($giatien > $thongtin['coin']) {
							$error  = array('status' => 0, 'messages' => 'Số dư của bạn không đủ để thực hiện giao dịch.');
						}else if($inf_hack['status'] != 0){
							$error  = array('status' => 0, 'messages' => 'Hiện tại bạn không thể thực hiện hành động này.');
						}
						else{
							$error  = array('status' => 99,  'messages' => array('soluong' => $soluong,'banhack' => $inf_hack['name'], 'price' => number_format($giatien), 'time' => $info_pack['time'], 'type' => $info_pack['loai'], 'pack' => $info_pack['id'] ));
						}
					}


					// Handle get info pack
				}else if($key == 1){
					$pack = htmlspecialchars(trim($_POST['pack']));
					$soluong = htmlspecialchars(trim($_POST['soluong']));
					if ($soluong < 1 ) {
						$error = array('status' => 0, 'messages' => 'Số lượng ít nhất là 1.' );
					}else if (!$hack->getPackHack($pack)) {
						$error  = array('status' => 0, 'messages' => 'Không tìm thấy gói hack.');
					}else if(!$hack->getListKeyByPackHack($pack)){
						$error  = array('status' => 0, 'messages' => 'Không tìm thấy key hack cho gói hack này.');
					}else if( count($hack->getListKeyByPackHack($pack)) < $soluong ){
						$error  = array('status' => 0, 'messages' => 'Số lượng key không đủ');
					}else{
						$info_pack = $hack->getPackHack($pack);
						$inf_hack = $hack->getInfoHack($info_pack['hack_id']);
						$giatien = $soluong*$info_pack['price'];
						if ($giatien > $thongtin['coin']) {
							$error  = array('status' => 0, 'messages' => 'Số dư của bạn không đủ để thực hiện giao dịch. Vui lòng nạp thêm tiền.');
						}else if($inf_hack['status'] != 0){
							$error  = array('status' => 0, 'messages' => 'Hiện tại bạn không thể thực hiện hành động này.');
						}
						else{
							$getListHack = $hack->getListKeyBySoLuong($info_pack['id'],$soluong);
							$time_format = date('Y-m-d',time());
							foreach ($getListHack as $key => $value) {
								$hack->buyHackKey($thongtin['id'],$info_pack['price'],$info_pack['id'],$value['info'],$info_pack['hack_id'],$info_pack['time'],$info_pack['loai'],$time_format);
							}
							$error = array('status' => 99, 'messages' => 'Thanh toán thành công. Vui lòng kiểm tra trong lịch sử giao dịch.');
						}
					}
				}

				// complete handle key
			}
		}else{-+
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