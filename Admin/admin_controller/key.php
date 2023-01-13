<?php
// error_reporting(0);
ini_set('display_errors', 0);
if (!isset($_GET['id']) || $_GET['id'] == '') {
	header('location: /Admin/home');
}else{

	$info_pack_hacks_key = $reset->getPackList($_GET['id']);
		// Danh mục hack nhưng là lis
	if ($info_pack_hacks_key) {
		$title = 'Gói: #'.$info_pack_hacks_key['id'].' - '.number_format($info_pack_hacks_key['price']).' vnđ / '.$info_pack_hacks_key['time'].' '.$info_pack_hacks_key['loai'];
		require 'admin_views/header.php';
		$keyList = $reset->listKeyHack($info_pack_hacks_key['id']);
		require 'admin_views/key.php';
	}else{
		header('location: /Admin/home');
	}
}
require 'admin_views/footer.php';
?>