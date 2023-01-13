<?php
// error_reporting(0);
ini_set('display_errors', 0);
$title = 'Quản Lý Danh Sách Game';
require 'admin_views/header.php';
$gamelist = $reset->gameList();
require 'admin_views/gamelist.php';

require 'admin_views/footer.php';
?>