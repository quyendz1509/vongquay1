<?php 
switch ($ctrl) {
	case 'home':
	require 'home.php';
	break;
// 
	case 'naptien':
	require 'naptien.php';
	break;
// 
	
// 
	case 'huongdan':
	require 'huongdan.php';
	break;
	case 'dangky':
	require 'dangky.php';
	break;
// 

	case 'dangnhap':
	require 'dangnhap.php';
	break;
// 

	case 'giaodich':
	require 'giaodich.php';
	break;
// 

	case 'nap-thecao':
	require 'nap-thecao.php';
	break;
// 

	case 'nap-momo':
	require 'nap-momo.php';
	break;
// 

	case 'nap-atm':
	require 'nap-atm.php';
	break;
// 

	case 'forget':
	require 'forget.php';
	break;
// 

	case 'giftcode':
	require 'giftcode.php';
	break;
	case 'logout':
	require 'logout.php';
	break;
// 

	case 'categogries':
	require 'categogries.php';
	break;
// 

	case 'details':
	require 'details.php';
	break;
// 

	case 'changepass':
	require 'changepass.php';
	break;
// 


// 

	default:
	require 'views/404.php';
	break;
// 

}
?>