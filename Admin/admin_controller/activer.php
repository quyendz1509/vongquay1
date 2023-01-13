<?php
error_reporting(0);
ini_set('display_errors', 0);
if (isset($_GET['id'])) {
	$id_banks = $_GET['id'];
	require '../modules/admin/handleBank.php';
	$bank = new handleBank();
	$hisList = $reset->checkBankById($id_banks);
	if ($hisList) {

		if ($hisList['bank_name'] == 'momo') {
			$title = 'Kích hoạt / Tắt kích hoạt ví điện tử momo: '.$hisList['username'];
			require 'admin_views/header.php';
			$settings_Banks = $reset->getBankConfig($info['id']);
			if (!isset($_SESSION['passwordpayment'])) {
				require 'admin_views/loginPayment.php';
			}else{
				if ( !password_verify($_SESSION['passwordpayment'], $settings_Banks['password_hash']) ) {
		/////////////
					unset($_SESSION['passwordpayment']);
					header('Location: '.$_SERVER['REQUEST_URI']);
				/////////////

				}else{
					$active_stt = ($hisList['status'] == 0) ? 1 : 0;
					$active_noidung = ($hisList['status'] == 0) ? 'kích hoạt ví' : 'Tắt kích hoạt';

					require 'admin_views/activer.php';

				}


			}
			require 'admin_views/footer.php';
		}else{
			header('Location: ../home');

		}

	}else{
		header('Location: ../home');

	}

}
?>