<?php 
error_reporting(0);
ini_set('display_errors', 0);
if (isset($_SESSION['id'])) {
	header('location: /home.html');
}else{
	$title = 'Đăng ký';
	require 'modules/auth.php';
	$auth = new classAuth();
	$images_array = array('./public/resource/game.png','./public/resource/game2.png','./public/resource/game3.png');
	$rand = mt_rand(0, count($images_array) -1 );
	require 'views/header.php';
	require 'views/dangky.php';

}
?>