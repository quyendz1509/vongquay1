<?php
error_reporting(0);
ini_set('display_errors', 0);
$title = 'Quản Lý Giftcode';
require 'admin_views/header.php';

$listGift = $reset->getListGiftcode();
require 'admin_views/giftcode.php';

require 'admin_views/footer.php';
?>