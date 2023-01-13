<?php 
session_start();
// set time zone
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Gọi database
require '../modules/database.php';

// gọi auth 
require '../modules/function.php';

$auth = new func();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$listvp = $auth->listVongQuay();
	$myfile = fopen("../bot.txt", "r") or die("Unable to open file!");
	$listname =  fread($myfile,filesize("../bot.txt"));
	fclose($myfile);
	$random_vp = rand(0, count($listvp) - 1);
	$explode  = explode("\n", $listname);
	$random_nguoidung = rand(0, count($explode) - 1);

	$error  = array('status' => 9, 'smg' => 'Tài khoản: <strong class="text-green-500">'.$explode[$random_nguoidung].'</strong> đã nhận được giải thưởng <strong class="text-teal-500">'.$listvp[$random_vp]['ten_vat_pham'].'</strong>.' );
}
if (isset($error)) {
	print_r(json_encode($error));
}
?>