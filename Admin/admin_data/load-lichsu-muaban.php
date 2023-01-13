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
		$history =  $reset->lichsu_muaban();
		foreach ($history as $key => $value) {
			
			$danhmuc = $reset->listHackGame($value['cate_id'])['name'];
			$username = $reset->check_account($value['user_id'])['username'];
			$data['data'][$key]->id = $value['id'];
			// danh mục
			$data['data'][$key]->danhmuc = '<span class="badge bg-primary">';
			$data['data'][$key]->danhmuc .= ($danhmuc == '') ? 'Không xác định': $danhmuc;
			$data['data'][$key]->danhmuc .= '</span>';
			// end danh mục
			$data['data'][$key]->username = '<strong class="text-warning">';
			$data['data'][$key]->username .= $username;
			$data['data'][$key]->username .= '</strong>';
// end danh mục
			$data['data'][$key]->price = '<span class="text-success ">';
			$data['data'][$key]->price .= number_format($value['price'] ).' đ';
			$data['data'][$key]->price .= '</span>';
			// buy at
			$data['data'][$key]->buyat = $value['buy_at'];
			// type
			$data['data'][$key]->type = '<span class="text-primary">';
			$data['data'][$key]->type .=  ($value['type'] == 1) ? 'Hack Game' : 'Acc Game';
			$data['data'][$key]->type .= '</span>';
			// thongtin them
			$data['data'][$key]->thongtin = '<textarea name="" class="form-control" id="" rows="5" readonly>';
			$data['data'][$key]->thongtin .= 'Tài khoản: '.$value['taikhoan'].' - Mật khẩu: '.$value['matkhau'].' - Thông tin thêm :'.$value['info'];
			$data['data'][$key]->thongtin .= '</textarea>';
		}
	}
}

echo json_encode($data);
?>
