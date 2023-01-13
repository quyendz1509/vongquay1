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
			$name = htmlspecialchars($_POST['name']);
			$status = htmlspecialchars($_POST['status']);
			$sapxep = htmlspecialchars($_POST['sapxep']);
			$rank = htmlspecialchars($_POST['rank']);

			if (!$reset->check_gamelist_slug($id,1)) {
				$error  = array('status' => 0, 'messages' => 'Không tồn tại gamelist trên');
			}else{
				
				if ($name == '' || $status == '' || $sapxep == '' || $rank == '') {
					$error  = array('status' => 0, 'messages' => 'Không bỏ trống thông tin bạn ưii');
				}else{
					$slug = $reset->to_slug($name);
					$reset->update_game($name,$slug,$status,$sapxep,$rank,$id);
					$error  = array('status' => 99, 'messages' => 'Chỉnh sửa thông tin <strong>'.$id.' </strong> thành công !');

				}
				
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