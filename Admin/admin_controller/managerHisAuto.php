<?php
error_reporting(0);
ini_set('display_errors', 0);

require '../modules/admin/handleBank.php';
$bank = new handleBank();

$title = 'Quản lý giao dịch tự động';
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
		require 'admin_views/managerHisAuto.php';

	}


}
require 'admin_views/footer.php';



?>