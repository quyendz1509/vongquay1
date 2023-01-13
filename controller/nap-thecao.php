<?php 
error_reporting(0);
ini_set('display_errors', 0);
require 'modules/product.php';
$title = 'Nạp Tiền Tự Động Thẻ Cào';
require 'all-header.php';
$class = new productClass();
if (isset($_SESSION['id'])) {
	require 'views/nap-thecao.php';
}else{
	header('location: /dangnhap.html');
}


require 'views/footer.php';

?>