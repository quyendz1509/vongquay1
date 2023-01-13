<?php 


/**
 * 
 */
class classAuth extends DATABASE
{


    // Created Account With Google
    function create_user_google($id_account,$email,$token,$gg_pic,$coin,$fullname){
        $sql= 'INSERT INTO `accounts`(`username`,`email`,`coin`,`token`,`email_id`,`fullname`,`google_picture` ) VALUES(?,?,?,?,?,?,?)';
        $this->pdo_execute($sql,$email,$email,$coin,$token,$id_account,$fullname,$gg_pic);
        $sql1 = 'SELECT * FROM `accounts` WHERE `email_id` = ?';
        return $this->pdo_query_one($sql1,$id_account);
    }
    // function check account google
    function check_google_account($id_account){
       $sql = 'SELECT * FROM `accounts` WHERE `username` = ?';
       return $this->pdo_query_one($sql,$id_account);
   }
 // create account normal
   function create_user($username,$password,$email,$coin,$token,$fullname,$phone){
    $sql = 'INSERT INTO `accounts`(`username`,`password`,`email`,`coin`,`token`,`fullname`,`phone`) VALUES(?,?,?,?,?,?,?)';
    $this->pdo_execute($sql,$username,$password,$email,$coin,$token,$fullname,$phone);
}
 // update token
function update_user($token,$username){
    $sql = 'UPDATE `accounts` SET `token` = ? WHERE `username` = ?';
    $this->pdo_execute($sql,$token,$username);
}
// function get account by email
function get_info_by_email($email){
    $sql='SELECT * FROM `accounts` WHERE `email` = ?';
    return $this->pdo_query_one($sql,$email);
}
// function get account by email
function get_info_by_token($token){
    $sql='SELECT * FROM `accounts` WHERE `token` = ?';
    return $this->pdo_query_one($sql,$token);
}
// function get info account by token and user
function get_token_and_user($user,$token){
    $sql='SELECT * FROM `accounts` WHERE  `id` = ? AND `token` = ?';
    return $this->pdo_query_one($sql,$user,$token);
}
// update user token and password
function update_user_by_forget($token,$password,$id){
    $sql='UPDATE `accounts` SET `token` = ?, `password` = ? WHERE `id` = ?';
    $this->pdo_execute($sql,$token,$password,$id);   
}

// 
  function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}
// send mail
function sendMail($title, $content, $nTo, $mTo,$diachicc=''){
    $nFrom = 'k93hax - Cung Cấp Hax Game Đỉnh Cao';
    $mFrom = 'testweb123.abcxyz@gmail.com';  //dia chi email cua ban 
    $mPass = 'leloc@@1110';       //mat khau email cua ban
    $mail             = new PHPMailer();
    $body             = $content;
    $mail->IsSMTP(); 
    $mail->CharSet   = "utf-8";
    $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
    $mail->SMTPAuth   = true;                    // enable SMTP authentication
    $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";        
    $mail->Port       = 465;
    $mail->Username   = $mFrom;  // GMAIL username
    $mail->Password   = $mPass;               // GMAIL password
    $mail->SetFrom($mFrom, $nFrom);
    //chuyen chuoi thanh mang
    $ccmail = explode(',', $diachicc);
    $ccmail = array_filter($ccmail);
    if(!empty($ccmail)){
        foreach ($ccmail as $k => $v) {
            $mail->AddCC($v);
        }
    }
    $mail->Subject    = $title;
    $mail->MsgHTML($body);
    $address = $mTo;
    $mail->AddAddress($address, $nTo);
    $mail->AddReplyTo('admin@k93hax.com', 'k93hax.COM');
    if(!$mail->Send()) {
        return 0;
    } else {
        return 1;
    }
}
}
?>