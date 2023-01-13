<?php
// error_reporting(0);
// ini_set('display_errors', 0);
if (isset($_GET['id'])) {
	$id_banks = $_GET['id'];
	$transid = $_GET['transid'];

	$hisList = $reset->checkBankById($id_banks);
	if ($hisList) {
		$title = 'Chi tiết Giao dịch - '.$transid;
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
				
				require 'admin_views/momoDetail.php';

			}


		}
		require 'admin_views/footer.php';
	}else{
		header('Location: ../home');

	}

}
?>