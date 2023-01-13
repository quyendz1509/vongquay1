<?php
// error_reporting(0);
ini_set('display_errors', 0);
if (!isset($_GET['id']) || $_GET['id'] == '') {
	header('location: /Admin/home');
}else{
	$title = 'Chỉnh sửa gói: #'.$_GET['id'];
	require 'admin_views/header.php';
	$info_pack_hack = $reset-> getPackList($_GET['id']);
		// Danh mục hack nhưng là list
	if ($info_pack_hack) {
		require 'admin_views/edit-pack.php';
	}else{
		header('location: /Admin/home');
	}
}
require 'admin_views/footer.php';
?>