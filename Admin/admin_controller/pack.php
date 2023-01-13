<?php
// error_reporting(0);
ini_set('display_errors', 0);
if (!isset($_GET['id']) || $_GET['id'] == '') {
	header('location: /Admin/home');
}else{

	$info_pack_hacks = $reset->getPackHack($_GET['id']);
		// Danh mục hack nhưng là lis
	if ($info_pack_hacks) {
		$title = 'Gói hack '.$info_pack_hacks['name'];
		require 'admin_views/header.php';
		$packList = $reset->getPackHackByCate($info_pack_hacks['id']);
		require 'admin_views/pack.php';
	}else{
		header('location: /Admin/home');
	}
}
require 'admin_views/footer.php';
?>