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
			$rank = htmlspecialchars($_POST['rank']);
			if ($name == '' || $rank == '') {
				$error  = array('status' => 0, 'messages' => 'Không được bỏ trống thông tin');
			}else{
				$slug = $reset->to_slug($name);
				if ($reset->check_gamelist_slug($slug)) {
					$error  = array('status' => 0, 'messages' => 'Đã tồn tại game: <strong class="text-danger">'.$name.'</strong> trên hệ thống.');
				}else{
					$reset->add_game_list($name,$slug,$rank);
					$error  = array('status' => 99, 'messages' => 'Thêm game <strong class="text-success">'.$name.'</strong> thành công !');
				}
				
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