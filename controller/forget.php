<?php 
error_reporting(0);
ini_set('display_errors', 0);
if (isset($_SESSION['id'])) {
	header('location: /home.html');
}else{
	$title = 'Lấy Lại Mật Khẩu';
	require 'modules/auth.php';
	$auth = new classAuth();
	$images_array = array('/public/uploads/img-10.jpg','/public/uploads/img-8.jpg','/public/uploads/img-9.jpg','/public/uploads/img-7.jpg');
	$rand = mt_rand(0,4);
	require 'views/header.php';
	require 'views/forget.php';

}
?>