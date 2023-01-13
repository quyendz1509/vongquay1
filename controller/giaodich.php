<?php 
error_reporting(0);
ini_set('display_errors', 0);
require 'modules/product.php';
$title = 'Lịch Sử Giao Dịch';
require 'all-header.php';
$class = new productClass();
if (isset($_SESSION['id'])) {
	$lichsu = $class->lichSuGiaoDich($_SESSION['id']);
	require 'views/giaodich.php';
}else{
	header('location: /home.html');
}


require 'views/footer.php';

?>