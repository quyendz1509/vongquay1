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
			$name = htmlspecialchars($_POST['name']);
			$cate = htmlspecialchars($_POST['cate']);
			$gioithieu = htmlspecialchars($_POST['gioithieu']);
			$hinhanh = htmlspecialchars($_POST['hinhanh']);
			$trangthai = htmlspecialchars($_POST['trangthai']);
			$main_down = htmlspecialchars($_POST['main_down']);
			$back_down = htmlspecialchars($_POST['back_down']);
			$huongdan = $_POST['huongdan'];
			$video = $_POST['video'];
			$id= htmlspecialchars($_POST['id']);
			if ($name == '' || $cate == '' || $gioithieu == '' || $hinhanh == '' || $video == '' || $trangthai == '' || $huongdan == '') {
				$error  = array('status' => 0, 'messages' => 'Không được bỏ trống thông tin');
			}else if(!$reset->checkCateHack($cate,'accgame')){
				$error  = array('status' => 0, 'messages' => 'Không tìm thấy danh mục hack');
			}else{
				$reset->updateHack($name,$gioithieu,$hinhanh,$cate,$video,$trangthai,$id,$main_down,$back_down,$huongdan);
				$error  = array('status' => 99, 'messages' => 'Cập nhật bản hack: <strong>'.$name.'</strong> thành công !');

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