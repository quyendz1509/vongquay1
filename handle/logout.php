<?php
ob_start();
session_start();
if (isset($_POST)) {
	session_destroy();
	echo 'done';
}
?>