<?php 
error_reporting(0);
ini_set('display_errors', 0);
require 'modules/product.php';
$title = 'Giftcode';
require 'all-header.php';
$class = new productClass();
if (isset($_SESSION['id'])) {
	
	require 'views/giftcode.php';
}else{
	header('location: /home.html');
}
	require 'views/footer.php';

?>