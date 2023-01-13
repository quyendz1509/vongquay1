<?php
//error_reporting(0);
//ini_set('display_errors', 0);
$title = 'Quản Lý Danh Mục';
require 'admin_views/header.php';
$gameList = $reset->gameList();
$cateList = $reset->categogriesList();
require 'admin_views/categogries.php';

require 'admin_views/footer.php';
?>