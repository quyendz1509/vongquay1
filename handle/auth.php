<?php 
session_start();
// set time zone
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Gọi database
require '../modules/public.php';

require '../modules/database.php';
// gọi auth 

//gọi thư viện gửi email


require '../modules/auth.php';
//
$auth = new classAuth();
if (isset($_POST['key']) && $_POST) {
	$key = htmlspecialchars($_POST['key']);
	if($key == 0){
		$fullname = htmlspecialchars(trim(strtoupper($_POST['fullname'])));
		$username = htmlspecialchars(trim($_POST['username']));
		$password = htmlspecialchars(trim($_POST['password']));
		$email = htmlspecialchars(trim($_POST['email']));
		$phone = htmlspecialchars(trim($_POST['phone']));
	$captcha = $_POST['g-recaptcha-response'];

		if(!$captcha){
			$erro = array( 'status' => -1, 'messages' => 'Vui lòng xác nhận captcha');
		}
		else if(empty($fullname) || empty($username) || empty($password) || empty($email)){
			$erro = array( 'status' => -1, 'messages' => 'Không bỏ trống thông tin.');
		}else if(strlen($password) < 6 || strlen($password) > 24 ){
			$erro = array( 'status' => -1, 'messages' => 'Mật khẩu tối thiểu 6 ký tự và tối đa 24 ký tự');
		}else if(strlen($username) < 6 || strlen($username) > 24 ){
			$erro = array( 'status' => -1, 'messages' => 'Mật khẩu tối thiểu 6 ký tự và tối đa 24 ký tự');
		}else if(strlen($phone) > 11){
			$erro = array( 'status' => -1, 'messages' => 'Số điện thoại tối đa 11 ký tự');
		}
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$erro = array( 'status' => -1, 'messages' => 'Email không hợp lệ' );
		}else if($auth->check_google_account($username)){
			$erro = array( 'status' => -1, 'messages' => 'Tài khoản đã tồn tại trên hệ thống.' );
		}else if($auth->get_info_by_email($email)){
			$erro = array( 'status' => -1, 'messages' => 'Đã tồn tại email trên hệ thống.' );
		}else{
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcT32MdAAAAAOWAL0Y1AVp4ASrt2RKLIzUcBng0&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
			$obj_res = json_decode($response);
			if(!$obj_res->success){
				$erro = array( 'status' => -1, 'messages' => 'Vui lòng không spam !' );
			}else{
				$token = bin2hex(random_bytes(36));
				if (empty($phone)) {
					$newPhone = NULL;
				}else{
					$newPhone = $phone;
				}
				$hashPass = md5($password);
				$auth->create_user($username,$hashPass,$email,0,$token,$fullname,$newPhone);

				$_SESSION['id'] = $auth->check_google_account($username)['id'];
				$erro = array('status' => 99 , 'messages' =>'Đăng ký thành viên thành công !');
			}
		}
		

	}else if($key == 1){
		$username = htmlspecialchars(trim($_POST['username']));
		$password = htmlspecialchars(trim($_POST['password']));
		if(empty($username) || empty($password) ){
			$erro = array( 'status' => -1, 'messages' => 'Không bỏ trống thông tin.');
		}else if(!$auth->check_google_account($username)){
			$erro = array( 'status' => -1, 'messages' => 'Không tìm thấy tài khoản trên hệ thống.' );
		}else if($auth->check_google_account($username)['status'] == 1){
			$erro = array( 'status' => -1, 'messages' => 'Tài khoản của bạn đã bị khóa.' );
		}else{

			$verify_pass = md5($password);
			if($verify_pass != $auth->check_google_account($username)['password']){
				$erro = array( 'status' => -1, 'messages' => 'Mật khẩu không chính xác.' );
			}else{
				$info_user = $auth->check_google_account($username);
				$_SESSION['id'] = $auth->check_google_account($username)['id'];
				$erro = array('status' => 99 , 'messages' =>'Đăng nhập hệ thống thành công !');
			}

		}
	}else if($key == 2 ){
		// Lấy lại mật khẩu
		$email = htmlspecialchars(trim($_POST['email']));
		$info = $auth->get_info_by_email($email);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$erro = array( 'status' => -1, 'messages' => 'Địa chỉ email không đúng định dạng.' );
		}else if(!$info){
			$erro = array( 'status' => -1, 'messages' => 'Không tìm thấy địa chỉ email.' );
		}else{
			$title = 'K93HAX | LẤY LẠI MẬT KHẨU CHO TÀI KHOẢN: '.$info['fullname'];
			$accual_link = "$_SERVER[HTTP_HOST]";
			$content = 'Xin chào bạn,<br>
			Cảm ơn bạn đã quan tâm đến các sản phẩm tại <a href="#">#</a>. Ai cũng có lúc đãng trí thế nên bạn đừng lo lắng.
			<br> 
			Để lấy lại mật khẩu của bạn với email <strong>'.$info['email'].'</strong> 
			<br>
			<a href="http://'.$accual_link.'/changepass/'.$info['token'].'">Nhấp vào đây.</a>';
			$nTo = 'K93HAX';
			$auth->sendMail($title, $content, $nTo, $email,$diachicc='');
			$erro = array( 'status' => 99, 'messages' => 'Lấy lại mật khẩu thành công! Vui lòng kiểm tra trong hòm thư của bạn.' );

		}
	}else if($key == 3){
		$password = htmlspecialchars(trim($_POST['password']));
		$token = htmlspecialchars(trim($_POST['token']));
		$user = htmlspecialchars(trim($_POST['user']));
		$info = $auth->get_token_and_user($user,$token);
		if ($password == '' || $token == '' || $user == '') {
			$erro = array( 'status' => -1, 'messages' => 'Không bỏ trống thông tin.');
		}else if(strlen($password) < 6 || strlen($password) > 24 ){
			$erro = array( 'status' => -1, 'messages' => 'Mật khẩu tối thiểu 6 ký tự và tối đa 24 ký tự');
		}else if(!$info){
			$erro = array( 'status' => -1, 'messages' => 'Không tìm thấy người dùng.');
		}else{
			$token = bin2hex(random_bytes(36));
			$hashPass = password_hash($password, PASSWORD_BCRYPT, []);
			$auth->update_user_by_forget($token,$hashPass,$info['id']);
			$erro = array( 'status' => 99, 'messages' => 'Thay đổi mật khẩu thành công!. Chuyển hướng đến trang đăng nhập.');
		}
	}


}

if (isset($erro)) {
	print_r(json_encode($erro));
}
?>