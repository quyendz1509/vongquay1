<?php
// error_reporting(0);
// ini_set('display_errors', 0);
if (isset($_GET['id'])) {
	$id_banks = $_GET['id'];
	require '../modules/admin/handleBank.php';
	$bank = new handleBank();
	$hisList = $reset->checkBankById($id_banks);
	if ($hisList) {
		$title = 'Lịch sử '.$hisList['bank_name'].' - '.$hisList['username'];
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

				require 'admin_views/manager-bank.php';

			}


		}
require 'admin_views/footer.php';
	}else{
				header('Location: ../home');

	}

}
?>