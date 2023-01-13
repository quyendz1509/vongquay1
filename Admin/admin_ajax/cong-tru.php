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
			$id = htmlspecialchars($_POST['id']);
			$sotien = htmlspecialchars($_POST['sotien']);
			$loai = htmlspecialchars($_POST['loai']);
			$messages = htmlspecialchars($_POST['lydo']);
			if (!$reset->check_account($id)) {
				$error  = array('status' => 0, 'messages' => 'Không tìm thấy tài khoản.');	
			}else if($sotien < 0){
				$error  = array('status' => 0, 'messages' => 'Số tiền không hợp lệ');	

			}else{
				$transid = $reset->randomString(12);
				$create = date('Y-m-d',time());
				$reset->congtru($id,$sotien,$loai,$transid,$messages,1,$create);
				$error  = array('status' => 99, 'messages' => 'Thực hiện hành động thành công!');
			}
		}

	}else{
		$error  = array('status' => 0, 'messages' => 'Cốc cốc ai dẩy ? ');
	}
}

if (isset($error)) {
	print_r(json_encode($error));
 	// code...
}