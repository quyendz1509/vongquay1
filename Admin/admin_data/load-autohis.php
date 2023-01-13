<?php
	error_reporting(0);
ini_set('display_errors', 0);
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
		$thongke =  $bank->listHistoryAllBank();
		foreach ($thongke as $key => $value) {
			$username = $reset->check_account($value['user_id'])['username'];
			$banks = $reset->checkBank($value['brand'])['name_bank'];

			$data['data'][$key]->id = $value['id'];
			// serial
			$data['data'][$key]->idtrans = '<span class="text-info">'.$value['trans_id'].'</span>';
			// serial
			// username
			$data['data'][$key]->username = $username;
			$data['data'][$key]->banks = '<span class="badge bg-primary">'.$banks.'</span>';

			// danh mục

// end danh mục
			$money = ( $value['amount']  != '' ) ? number_format($value['amount']) : 0 ; 
			$data['data'][$key]->price = '<span class="text-success">';
			$data['data'][$key]->price .= $money.' đ';
			$data['data'][$key]->price .= '</span>';
			// buy at
				// thongtin them
			if ($value['status'] == 1) {
				$stt = '<span class="badge bg-success">Đã thực  hiện</span>';
			}else{
				$stt = '<button class="btn btn-sm btn-primary duyet-tay" data-id="'.$value['id'].'">Duyệt tay</button>';
			}
			$data['data'][$key]->stt .= $stt;
			// date
			$data['data'][$key]->date .= $value['time_create'];
			
		}
	}
}

echo json_encode($data);
?>
