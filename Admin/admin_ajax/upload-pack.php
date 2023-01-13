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
			$id = htmlspecialchars($_POST['id']);
			$money = htmlspecialchars($_POST['money']);
			$time = htmlspecialchars($_POST['time']);
			$type = htmlspecialchars($_POST['type']);

			if ($id == '' || $money == '' || $time == '' || $type == '') {
				$error  = array('status' => 0, 'messages' => 'Không được bỏ trống thông tin');
			}else if(!$reset->getPackHack($id)){
				$error  = array('status' => 0, 'messages' => 'Không tìm thấy bản hack');
			}else{
				$reset->uploadPackHack($money,$time,$id,$type);
				$error  = array('status' => 99, 'messages' => 'Đã thêm gói hack thành công !');

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