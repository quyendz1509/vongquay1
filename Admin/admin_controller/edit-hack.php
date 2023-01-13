<?php
// error_reporting(0);
ini_set('display_errors', 0);
if (!isset($_GET['id']) || $_GET['id'] == '') {
	header('location: /Admin/home');
}else{
	$title = 'Chỉnh sửa: #'.$_GET['id'];
	require 'admin_views/header.php';
	$info_ban_hack = $reset->listHackGame($_GET['id']);
		// Danh mục hack nhưng là list
	$cate_list_hack = $reset->categogriesList('accgame');
	if ($info_ban_hack) {
		require 'admin_views/edit-hack.php';
	}else{
		header('location: /Admin/home');
	}
}
require 'admin_views/footer.php';
?>