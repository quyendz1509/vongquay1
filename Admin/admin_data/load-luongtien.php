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
		$thongke =  $reset->list_card();
		foreach ($thongke as $key => $value) {
			$username = $reset->check_account($value['username'])['username'];
			$data['data'][$key]->id = $value['id'];
			// serial
			$data['data'][$key]->idtrans = $value['trans_id'];
			// serial
			$data['data'][$key]->serial = ($value['serial'] == '') ? 'Trống' : $value['serial'];
			$data['data'][$key]->pin = ($value['pin'] == '') ? 'Trống' : $value['pin'];

			// username
			$data['data'][$key]->username = $username;
			// danh mục


// end danh mục
			$data['data'][$key]->price = '<span class="text-success ">';
			$data['data'][$key]->price .= number_format($value['money'] ).' đ';
			$data['data'][$key]->price .= '</span>';
			// buy at
		
			// type
			if ($value['type'] == 'trutien') {
				$typer = 'Trừ tiền';
			}else if($value['type'] == 'admin'){
				$typer = 'Cộng tiền';

			}else{
				$typer = $value['type'];
			}
			$data['data'][$key]->type = '<span class="text-primary">';
			$data['data'][$key]->type .=  $typer;
			$data['data'][$key]->type .= '</span>';
			// thongtin them
			$data['data'][$key]->noidung = '<textarea name="" class="form-control" id="" rows="5" readonly>';
			$data['data'][$key]->noidung .= $value['messages'];
			$data['data'][$key]->noidung .= '</textarea>';
				// thongtin them
			if ($value['status'] == 1) {
				$stt = 'Đã thực  hiện';
			}else if ($value['status'] == 2) {
				$stt = 'Bị từ chối';
			}else if ($value['status'] == 3) {
				$stt = 'Bill trừ tiền';

			}else{
				$stt = 'Chưa thực hiện';
			}
			$data['data'][$key]->stt .= $stt;
			// date
			$data['data'][$key]->date .= $value['time_stamp'];
			
		}
	}
}

echo json_encode($data);
?>
