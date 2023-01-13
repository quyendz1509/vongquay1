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
if (isset($_POST)) {
	if (isset($_SESSION['id'])) {
		// thông tin người dùng...
		$thongtin = $reset->check_account($_SESSION['id']);
 		// quyền 
		$websetting = $reset->infoSettingWeb();
		if ($thongtin['rules'] != $websetting['role_admin']) {
			$error  = array('status' => 0, 'messages' => 'Bạn là ai? không phải admin thì không có quyền đâu nha :D ');
		}else{
			// Xử lý người dùng
			$test = $_FILES;
			foreach ($test['file']['name'] as $key => $value) {
				$tmpFilePath = $_FILES['file']['tmp_name'][$key];
				$type = $test['file']['type'][$key];
				if ($type != 'image/png' && $type != 'image/jpg' && $type != 'image/jpeg' && $type != 'image/gif') {
					$error[]  = array('status' => 0, 'messages' => 'Tệp tin: '.$test['file']['name'][$key].' Không đúng định dạng.');
				}else{
					if($tmpFilePath == ''){
						$error[]  = array('status' => 0, 'messages' => 'Tệp tin: '.$test['file']['name'][$key].' đã bị xóa khỏi thư mục gốc.');
					}
					else{
						$newTargetfile = '../../public/uploads/'.$test['file']['name'][$key];

						if (file_exists($newTargetfile)) {
							$error[] = array('status' => 0, 'messages' => 'Tệp tin '.$test['file']['name'][$key].' đã tồn tại');
						}else{
							if (move_uploaded_file($test["file"]["tmp_name"][$key], $newTargetfile)) {
								$reset->upload_images('/public/uploads/'.$test['file']['name'][$key]);
								$error[]  = array('status' => 99, 'messages' => 'Tải lên tệp:'.$test['file']['name'][$key].' thành công.' );
							}else{
								$error[]  = array('status' => 0 , 'messages' => 'Đã có 1 số lỗi xảy ra.' );
							}
						}

					}
				}

			}
			// kết thúc xử lý
		}
	}
}
if (isset($error)) {
	print_r(json_encode($error));
}
?>
