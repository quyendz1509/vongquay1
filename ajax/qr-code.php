<?php 
if (isset($_GET['param'])) {
	echo 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$_GET['param'].'&choe=UTF-8';
}else{
	echo '404 Bad Request';
}
?>