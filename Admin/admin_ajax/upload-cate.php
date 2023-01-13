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
			$game = htmlspecialchars($_POST['game']);
			$hinhanh = htmlspecialchars($_POST['hinhanh']);
			$content = htmlspecialchars($_POST['content']);
			$loai = htmlspecialchars($_POST['loai']);

			$slug = $reset->to_slug($name.'-'.$game);
			if ($name == '' || $game == '' || $hinhanh == '' || $content == '') {
				$error  = array('status' => 0, 'messages' => 'Không được bỏ trống thông tin');
			}else if(!$reset->check_gamelist_slug($game,1)){
				$error  = array('status' => 0, 'messages' => 'Không tìm thấy Game');
			}else if($reset->check_cate_id($slug,1)){
				$error  = array('status' => 0, 'messages' => 'Đã tồn tại danh mục: <strong>'.$name.'</strong>');
			}else{
				$reset->add_cate($name,$slug,$hinhanh,$game,$loai,$content);
				$error  = array('status' => 99, 'messages' => 'Đã thêm danh mục: <strong>'.$name.'</strong> thành công !');

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