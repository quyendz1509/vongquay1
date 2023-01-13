<?php 
// error_reporting(0);
// ini_set('display_errors', 0);
$title = 'Quản lý ngân hàng';
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
		$listPayment = $reset->getListBank($info['id']);
		$tinhtoanb = $reset->tinhToanBankDaSuDung($info['id']);
		require 'admin_views/payment.php';
	}
	

}
require 'admin_views/footer.php';
?>