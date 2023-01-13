<?php
// error_reporting(0);
// ini_set('display_errors', 0);

if (!isset($_GET['cate'])) {
	header('location: /Admin/home');
}else{
	// Thông tin cate
	$info_cate = $reset->check_cate_id($_GET['cate']);
	// Danh mục hack nhưng là list
	$cate_list_hack = $reset->categogriesList('accgame');
	
	
	if (!$info_cate) {
		header('location: /Admin/home');
	}else{
		$title = 'Quản Lý sản phẩm #'.$info_cate['name'];
		require 'admin_views/header.php';
		// thông tin game list
		$info_gamelist = $reset->check_gamelist_slug($info_cate['gamelist_id'],1);
		// thông tin ranks 
		$info_ranks = $reset->rank_list($info_gamelist['loairank']);
		// list acc 
		$list_acc = $reset->list_account_cate($info_cate['id']);
// List bản hack 
		$hackList = $reset->getListHackGameByID($info_cate['id']);
		if ($info_cate['theloai'] == 'accgame') {
			require 'admin_views/products.php';

		}else{
			require 'admin_views/quanly-hackgame.php';

		}

		require 'admin_views/footer.php';
	}
}
?>