<?php
error_reporting(0);
ini_set('display_errors', 0);
$title = 'Quản Lý Web';
require 'admin_views/header.php';
$admin_list = $reset->admin_history();
require 'admin_views/admin-log.php';

require 'admin_views/footer.php';
?>