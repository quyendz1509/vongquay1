<?php 
error_reporting(0);
ini_set('display_errors', 0);
if (isset($_SESSION['id'])) {
	header('location: /home.html');
}else{

	if (!isset($_GET['token'])) {
		header('location: /home.html');
	}else{
		$title = 'Lấy Lại Mật Khẩu';
		require 'modules/auth.php';
		$auth = new classAuth();
		$info = $auth->get_info_by_token($_GET['token']);
		if (!$info) {
			header('location: /home.html');
		}else{

			require 'views/header.php';
			require 'views/changepass.php';
		}

	}


}
?>