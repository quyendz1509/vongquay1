<?php
// error_reporting(0);
ini_set('display_errors', 0);
$title = 'Quản Lý Hình Ảnh';
require 'admin_views/header.php';

$images = $reset->list_images();
require 'admin_views/hinhanh.php';

require 'admin_views/footer.php';
?>