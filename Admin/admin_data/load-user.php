<?php
header('Content-type: application/json');

session_start();
// set time zone
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Gọi database
require '../../modules/database.php';
// Gọi class function sử dụng chung
require '../../modules/admin/function.php';
// handle bank
require '../../modules/admin/handleBank.php';
$reset = new classFuncAdmin();
$bank = new handleBank();
$data  = array('data' => array());
if (isset($_SESSION['id'])) {
	$thongtin = $reset->check_account($_SESSION['id']);
 		// quyền 
	$websetting = $reset->infoSettingWeb();
	if ($thongtin['rules'] != $websetting['role_admin']) {
		$error  = array('status' => 0, 'messages' => 'Bạn là ai? không phải admin thì không có quyền đâu nha :D ');
	}else{
		$list_user = $reset->list_user();
		foreach ($list_user as $key => $value) {
			$data['data'][$key]->id = $value['id'];
			

			if ($value['rules'] == 1) {
				$rules = 'Admin';
			}else if($value['rules'] == 0){
				$rules = 'Thành viên';
			}else{
				$rules = 'Reseller';
			}

			$data['data'][$key]->rules = $rules;

			$data['data'][$key]->fullname = $value['fullname'];
			$data['data'][$key]->username = $value['username'];
			$sotien = '<span class="text-success sotien-'.$value['id'].'">'.number_format( $value['coin'] ).' vnđ</span>';
			$data['data'][$key]->sotien = $sotien;
			$data['data'][$key]->email = $value['email'];
			$another = '<div class="btn-group" style="min-width: 190px; max-width: 220px;">';
			$another .= '<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#cong-tru-tien" data-id='.$value['id'].'>Cộng - Trừ tiền</button>';
			if ($value['status'] == 0) {
				$another .= '<button class="btn btn-danger btn-sm khoa-taikhoan" data-stt="1" data-id='.$value['id'].'>Khóa</button>';
			}else{
				$another .= '<button class="btn btn-success btn-sm khoa-taikhoan" data-stt="0" data-id='.$value['id'].'>Mở khóa</button>';

			}
			$another .= '</div>';
			$data['data'][$key]->another = $another;

		}
	}
}

echo json_encode($data);
?>
