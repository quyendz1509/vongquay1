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
			$main_link = htmlspecialchars($_POST['main_link']);
			$back_link = htmlspecialchars($_POST['back_link']);
			$huongdan = $_POST['huongdan'];
			$video = $_POST['video'];

			if ($name == '' || $cate == '' || $gioithieu == '' || $hinhanh == '' || $video == '' || $main_link =='' || $back_link == '' || $huongdan == '') {
				$error  = array('status' => 0, 'messages' => 'Không được bỏ trống thông tin');
			}else if(!$reset->checkCateHack($cate,'accgame')){
				$error  = array('status' => 0, 'messages' => 'Không tìm thấy danh mục hack');
			}else{
				$reset->uploadHack($name,$gioithieu,$hinhanh,$cate,$video,$main_link,$back_link,$huongdan);
				$error  = array('status' => 99, 'messages' => 'Đã thêm bản hack: <strong>'.$name.'</strong> thành công !');

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