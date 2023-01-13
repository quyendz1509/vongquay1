<?php
session_start();
// set time zone
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Gọi database
require '../modules/database.php';

// gọi auth 
require '../modules/function.php';

$auth = new func();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// code...
	if (isset($_SESSION['id'])) {
		$thongtin = $auth->check_account($_SESSION['id']);

		if ($thongtin) {

			$listvongquay = $auth->listVongQuay();
			if($thongtin['coin'] < 1){
				
			$error = array('status' => 0, 'smg' => 'Bạn đã hết lượt quay.');

			}else if( count($listvongquay) > 0 ){
				$array_new  = array();

				foreach ($listvongquay as $key => $value) {
				$array_new[$value['id']] = $value['ti_le']; // lấy mảng tỉ lệ
			}
			$giaithuong = $auth->tinhtilevongquay($array_new);
			// chạy vòng lặp 1 lần nữa để lấy cái position
			$position = 0;
			foreach ($listvongquay as $key => $value) {
				if($value['id'] == $giaithuong){
						$position = $key + 1;
					break;	
				}
			}

			$thongtin_giai = $auth->getInfoOfGiaiThuong($giaithuong);
			$trutien = $auth->truTienCallBack(1,$thongtin['id']);
			if ($trutien == '') {
				$reInfo = $auth->check_account($thongtin['id']);
			$sms = 'Chúc mừng bạn nhận được giải thưởng: <strong class="text-red-600 font-bold">'.$thongtin_giai['ten_vat_pham'].' !</strong>';
			$error = array('status' => 99, 'smg' => $sms, 'position' => $position, 'luotquay' => $reInfo['coin'],'icon' => $thongtin_giai['icon']);
			}else{
			$error = array('status' => 0, 'smg' => 'Không thể tải dữ liệu' );

			}
			
		}else{
			$error = array('status' => 0, 'smg' => 'Vòng quay không hợp lệ.');
		}

	}else{
		$error = array('status' => 0, 'smg' => 'Không tìm thấy tài khoản của bạn.');
	}
}else{
	$error = array('status' => 0, 'smg' => 'Bạn chưa đăng nhập. Vui lòng đăng nhập tài khoản.');
}

if (isset($error)) {
	print_r(json_encode($error));
}
}
?>
