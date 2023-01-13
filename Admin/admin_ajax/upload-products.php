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
			$taikhoan = htmlspecialchars($_POST['taikhoan']);
			$matkhau = htmlspecialchars($_POST['matkhau']);
			$price = htmlspecialchars($_POST['price']);
			$info = htmlspecialchars($_POST['info']);
			$level = htmlspecialchars($_POST['level']);
			$skin = htmlspecialchars($_POST['skin']);
			$rank = htmlspecialchars($_POST['rank']);
			$champs = htmlspecialchars($_POST['champs']);
			$images = htmlspecialchars($_POST['images']);
			$list_img = htmlspecialchars($_POST['list_img']);
			$cate = htmlspecialchars($_POST['cate']);
			$rp = htmlspecialchars($_POST['rp']);
			$lienket = htmlspecialchars($_POST['lienket']);

			if ($taikhoan == '' || $matkhau == '' || $price == '' || $info == '' || $level == '' || $skin == '' || $rank == '' || $champs == '' || $images == ''|| $list_img == '' || $rp  == '' || $lienket == '') {
				$error  = array('status' => 0, 'messages' => 'Không được bỏ trống thông tin');
			}else if(!$reset->check_cate_id($cate)){
				$error  = array('status' => 0, 'messages' => 'Không tồn tại danh mục: <strong>'.$cate.'</strong>');
			}else{
				// $reset->add_cate($name,$slug,$hinhanh,$game,'accgame',$content);
				$reset->add_products($taikhoan,$matkhau,$price,$images,$list_img,$info,$level,$skin,$rank,$champs,$cate,$rp,$lienket);
				$error  = array('status' => 99, 'messages' => 'Đã thêm tài khoản mới thành công !');

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