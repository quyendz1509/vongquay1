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
			$linkfb = htmlspecialchars($_POST['linkfb']);
			$km_napthe = htmlspecialchars($_POST['km_napthe']);
			$km_atm = htmlspecialchars($_POST['km_atm']);
			$phone = htmlspecialchars($_POST['phone']);
			$trangthai = htmlspecialchars($_POST['trangthai']);
			$thongbao = htmlspecialchars($_POST['thongbao']);
			$noidung = htmlspecialchars($_POST['noidung']);
			$cuphap = htmlspecialchars($_POST['cuphap']);
			$zalo = htmlspecialchars($_POST['zalo']);
			$support = htmlspecialchars($_POST['support']);
			$diem = htmlspecialchars($_POST['diem']);
			$noticehome = $_POST['noticehome'];
			if ($noticehome == '' || $support== '' || $zalo == '' || $linkfb == '' || $km_atm == '' || $km_napthe == '' || $phone == '' || $trangthai == '' || $thongbao == '' || $noidung == '' || $cuphap == '' || $diem == '') {
				$error  = array('status' => 0, 'messages' => 'Không được bỏ trống thông tin rồi mà @@');
			}else{
				$reset->updateSetting($linkfb,$km_napthe,$km_atm,$trangthai,$noidung,$thongbao,$phone,$cuphap,$zalo,$support,$diem,$noticehome);
				$error  = array('status' => 99, 'messages' => 'Cập nhật trang web thành công !');
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