<?php 
session_start();
// set time zone
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Gọi database
require '../../modules/database.php';
// Gọi class function sử dụng chung
require '../../modules/admin/function.php';
//
$reset = new classFuncAdmin();

if (isset($_POST) && $_POST) {
	if (isset($_SESSION['id'])) {
 		// thông tin người dùng...
		$thongtin = $reset->check_account($_SESSION['id']);
 		// quyền 
		$websetting = $reset->infoSettingWeb();
		if ($thongtin['rules'] != $websetting['role_admin']) {
			$error  = array('status' => 0, 'messages' => 'Bạn là ai? không phải admin thì không có quyền đâu nha :D ');
		}else{
	// Xử lý code ở đây nha
			$soluong = htmlspecialchars($_POST['soluong']);
			$price = htmlspecialchars($_POST['price']);

			if ($soluong == '' || $price == '') {
				$error  = array('status' => 0, 'messages' => 'Không được bỏ trống thông tin');
			}else if($soluong < 1){
				$error  = array('status' => 0, 'messages' => 'Số lượng tối thiểu 1 key');

			}else if($price < 1000){
				$error  = array('status' => 0, 'messages' => 'Giá tiền phải từ 1.000 vnđ');

			}else{
				$time = date('Y-m-d', time());
				for ($i=0; $i < $soluong; $i++) { 
					$code = 'K93-'.$reset->randomString(6);
					$reset->uploadGiftcode($price,$code,$time);
				}
				$error  = array('status' => 99, 'messages' => 'Thêm <strong class="text-danger">'.$soluong.'</strong> Gift thành công !');	
			}

	// Kết thúc xử lý code ở đây nha

		}
	}else{
		$error  = array('status' => 0, 'messages' => 'Cốc cốc ai dẩy ? ');
	}
}

if (isset($error)) {
	print_r(json_encode($error));
 	// code...
}