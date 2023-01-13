<?php 

class func extends DATABASE
{
  function truluotquay(){

  }
  function getInfoOfGiaiThuong($id){
    $sql='SELECT * FROM `vongquay` WHERE `id` = ?';
    return $this->pdo_query_one($sql,$id);
  }
  function listVongQuay(){
    $sql='SELECT * FROM `vongquay` WHERE `status` = 0 ORDER BY `id` DESC';
    return $this->pdo_query($sql);
  }
function tinhtilevongquay($weights) {

    $rand = mt_rand(1, (int) array_sum($weights));

    foreach ($weights as $key => $value) {
        $rand -= $value;
        if ($rand <= 0) {
            return $key;
        }
    }
}
function getCategogries(){
  $sql='SELECT categogries.gamelist_id, categogries.name,categogries.status,categogries.sapxep, gamelist.name as `game_name` FROM `categogries` INNER  JOIN `gamelist` ON categogries.gamelist_id = gamelist.id ORDER BY categogries.status ASC';
  return $this->pdo_query($sql);
}
function getInfoBankSupportByBrand($brand){
  $sql='SELECT * FROM `bank_support` WHERE `brand` = ?';
  return $this->pdo_query_one($sql,$brand);
}
// 

  
  function check_account($id_account){
    $sql = 'SELECT * FROM `accounts` WHERE `id` = ?';
    return $this->pdo_query_one($sql,$id_account);
  }



 // actual link 
 function actualLink(){
  return $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}




  //  lấy thông tin setting web
function infoSettingWeb(){
  return $this->pdo_query_one('SELECT * FROM `settings`');
}
// 
function generateRandomString($length) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

// check thẻ 
function curl_napthe($url){
   //Mã đơn hàng của bạn
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
  curl_close($ch);
  return $result; 
}
      // Thêm thẻ vào database
function addTheCao($serial,$pin,$money,$type,$userid,$transid,$messages,$time,$loai){
  $sql='INSERT INTO `cards`(`serial`,`pin`,`money`,`type`,`username`,`trans_id`,`messages`,`create_at`,`loai`) VALUES(?,?,?,?,?,?,?,?,?)';
  $this->pdo_execute($sql,$serial,$pin,$money,$type,$userid,$transid,$messages,$time,$loai);
}

         // Lấy thông tin loại thẻ banks
function thongtinBanks($nganhang){
  $sql='SELECT * FROM `banks` WHERE `nganhang` != ?';
  return $this->pdo_query($sql,$nganhang);
}

      // cộng tiền 
function truTienCallBack($price,$userid){
  $sql = 'UPDATE `accounts` SET `coin` = `coin` - ? WHERE `id` = ?';
  $this->pdo_execute($sql,$price,$userid);
}

}

?>