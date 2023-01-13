<?php 
class classFuncAdmin extends DATABASE
{
	// get list bank supprot
	function getListbankByStatus($status){
		$sql='SELECT * FROM `bank_support` WHERE `status` = ? ';
		return $this->pdo_query($sql,$status);
	}
	// tinh toán người đó đã sử dụng bao nhiêu tài khoản
	function tinhToanBankDaSuDung($id){
		$sql='SELECT COUNT(*) FROM `banks` WHERE `id_admin` = ?';
		$conter_ = $this->pdo_query_values($sql,$id);
		// lấy thông tin
		$info = $this->getBankConfig($id);
		$sms = '';
		if ($conter_ >= $info['bank_using']) {
			$sms = 0;
		}else{
			$sms = array('bank_using' => $conter_, 'bank_exits' => $info['bank_using']);
		}
		return $sms;
	}
	function updateBanksConfig($password,$id){
		$sql='UPDATE `banks_config` SET `password_hash` = ? WHERE `id_admin` = ?';
		$this->pdo_execute($sql,$password,$id);
	}
	// lấy thông tin tài khoản được thêm bank
	function getBankConfig($id){
		$sql='SELECT * FROM `banks_config` WHERE `id_admin` = ?';
		return $this->pdo_query_one($sql,$id);
	  // function get list bank
	}
	function getListBank($id){
		$sql='SELECT * FROM `banks` WHERE `id_admin` = ?';
		$result = $this->pdo_query($sql,$id);
		$new_image = array();
		$sql2 = 'SELECT * FROM `bank_support` WHERE `brand` = ?';

		foreach ($result as $key => $value) {
			$result_2 = $this->pdo_query_one($sql2,$value['bank_name']);
			$new_image[$key] = $result_2;

		}
		return array('bank' => $new_image, 'data' => $result);

	}


	// getcaptcha Mbbank
	function getCaptchaMbBank(){
		$command = 'retail-web-internetbankingms/getCaptchaImage';
		
		$data  =  array(
			'deviceIdCommon' => $this->makedeviceIdCommon(),
			'refNo' => $this->mbRefNo(),
			'sessionId' => "",
		);
		$re_captcha = $this->CURL_MBBANK($command,$data);
		$bypass_captcha = $this->bypassCaptcha($re_captcha->imageString);
		return $bypass_captcha;
	}
	function CURL_MBBANK($COMMAND,$data,$userId=''){
		$url = 'https://online.mbbank.com.vn/'.$COMMAND;
		$requestx = ($userId != '') ? $userId.'-' : '';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Accept: application/json, text/plain, */*',
			'Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5',
			'Authorization: Basic QURNSU46QURNSU4=',
			'Connection: keep-alive',
			'Content-Type: application/json; charset=UTF-8',
			'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36',
			'X-Request-Id: '.$requestx.$this->mbRefNo(),
			'Cookie: MBAnalyticsaaaaaaaaaaaaaaaa_session_=CMNGMIMJNJIGCDHLPLPKMFLBIJNKENOBOJJMKEKMIGMKOPMHMDGDHMANLFPCKDABGFJDGFGEIJDCOLFMGNPAINEBEGJNEMONKFMEJGBCMNMKMIHJNDPFPADLFCNAGOGJ; BIGipServeronline_mbbank_retail_web_pool_8686=2433876234.60961.0000'
		));
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		$result = curl_exec($ch);
		curl_close($ch);
		$result_captcha = json_encode($result);
		$bypass = $this->bypassCaptcha('data:image/png;base64,'.$result_captcha);
		return $bypass;
	}
	function bypassCaptcha($string){

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.apitruecaptcha.org/one/gettext',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS =>'{
				"userid": "quyendz1509@gmail.com",
				"apikey": "eB34LRCv0nWqM41q30IQ",
				"data": "'.$string.'"
			}',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		return json_decode($response);

	}
	function mbRefNo(){
		$rand = mt_rand(10,99);
		$time = date('YmdHis',time());
		return $time.$rand;
	}
	// make refNo with value
	function makeRefNo($t){
		return $t.'-'.$this->mbRefNo();
	}
	// make device
	function makedeviceIdCommon(){
		$test =  $this->generateRandom(8).'-mbib-0000-0000';
		return $this->makeRefNo($test);
	}



	// 
	function checkBank($brand){
		$sql='SELECT * FROM `bank_support` WHERE `brand` = ?';
		return $this->pdo_query_one($sql,$brand);
	}
	function checkBankById($id){
		$sql='SELECT * FROM `banks` WHERE `id` = ?';
		return $this->pdo_query_one($sql,$id);
	}
	//get list bank supprot
	function listBankSupport(){
		$sql='SELECT * FROM `bank_support` ORDER BY `status` ASC';
		return $this->pdo_query($sql);
	}
	// 
	function add_log_admin($noidung){
		$sql = 'INSERT INTO `admin_history`(`noidung`) VALUES(?)';
		$this->pdo_execute($sql,$noidung);
	}
	function getInfoGiftCode($id){
		$sql='SELECT * FROM `giftcode` WHERE `id` = ?';
		return $this->pdo_query_one($sql,$id);
	}
	function lichsu_muaban(){
		$sql= 'SELECT * FROM `history` ORDER BY `id` DESC';
		return $this->pdo_query($sql);
	}
	//
	function getListGiftcode(){
		$sql='SELECT * FROM `giftcode`';
		return $this->pdo_query($sql);
	}
	// thêm giftcode
	function uploadGiftcode($price,$code,$time){

			// code...
		$sql='INSERT INTO `giftcode`(`price`,`code`,`time`)  VALUES(?,?,?)';
		$this->pdo_execute($sql,$price,$code,$time);
		
	}

	//upload key hack
	function uploadKeyHack($info,$pack){
		$sql='INSERT INTO `key_list_hack`(`info`,`pack_id`) VALUES(?,?)';
		$this->pdo_execute($sql,$info,$pack);
	}
	function checkKeyHack($id){
		$sql='SELECT * FROM `key_list_hack` WHERE `id` = ? ';
		return $this->pdo_query_one($sql,$id);

	}
	// show list key 
	function listKeyHack($pack){
		$sql='SELECT * FROM `key_list_hack` WHERE `pack_id` = ?';
		return $this->pdo_query($sql,$pack);
	}
	// uppload pack hack
	function uploadPackHack($price,$time,$hack_id,$loai){
		$sql='INSERT INTO `pack_hack`(`price`,`time`,`hack_id`,`loai`) VALUES(?,?,?,?)';
		$this->pdo_execute($sql,$price,$time,$hack_id,$loai);
	}
				// xóa giftcode
	function deleteGift($id){
		$sql='DELETE FROM `giftcode` WHERE `id` = ?';
		$this->pdo_execute($sql,$id);
	}
			// xóa pack
	function deleteKey($id){
		$sql='DELETE FROM `key_list_hack` WHERE `id` = ?';
		$this->pdo_execute($sql,$id);
	}
		// xóa pack
	function deletePack($id){
		$sql='DELETE FROM `pack_hack` WHERE `id` = ?';
		$this->pdo_execute($sql,$id);
	}
	//update gói hack
	function updatePackHack($price,$time,$loai,$id){
		$sql='UPDATE `pack_hack` SET `price` = ?,`time`= ?, `loai`= ? WHERE `id` = ?';
		$this->pdo_execute($sql,$price,$time,$loai,$id);
	}
	// get list pack hack
	function getPackList($id=''){
		if ($id != '') {
			$sql='SELECT * FROM `pack_hack` WHERE `id` = ? ';
			return $this->pdo_query_one($sql,$id);
		}else{
			$sql='SELECT * FROM `pack_hack`';
			return $this->pdo_query($sql);
		}
	}
	// get pack hack list
	function getPackHackByCate($cate_id){
		$sql='SELECT * FROM `pack_hack` WHERE `hack_id` = ?';
		return $this->pdo_query($sql,$cate_id);
	}
	// Lấy danh sách gói
	function getPackHack($id){
		if ($id != '') {
			// code...
			$sql='SELECT * FROM `list_hack` WHERE `id` = ?';
			return $this->pdo_query_one($sql,$id);
		}
	}
	//get list hướng dẫn
	function listHuongDan(){
		$sql='SELECT * FROM `huongdan`';
		return $this->pdo_query($sql);
	}
	// random string
	function randomString($length) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
		 // function check account google
	function check_account($id_account){
		$sql = 'SELECT * FROM `accounts` WHERE `id` = ?';
		return $this->pdo_query_one($sql,$id_account);
	}
	// Tổng doanh thu
	function tongDoanhThu($key,$action){
		// Tổng doanh thu theo ngày
		if ($key == 'day') {
			$sql='SELECT SUM(`price`) FROM `history` WHERE `buy_day` = ?';
			return $this->pdo_query_values($sql,$action);
			// Tổng theo tháng
		}else if($key == 'month'){
			$sql='SELECT SUM(`price`) FROM `history` WHERE MONTH(`buy_day`) = ?';
			return $this->pdo_query_values($sql,$action);
		}else if($key == 'card'){
				// Tổng nạp thẻ hôm nay :D 
			$sql='SELECT SUM(`money`) FROM `cards` WHERE `create_at` = ? AND `loai` != "trutien"';
			return $this->pdo_query_values($sql,$action);				
		}else if($key == 'card-thangs'){
			$sql='SELECT SUM(`money`) FROM `cards` WHERE MONTH(`create_at`) = ? AND `loai` != "trutien"';
			return $this->pdo_query_values($sql,$action);			
		}
	}
	// Tổng doanh thu theo loại
	function doanhThuByType($loai,$days){
		$sql='SELECT SUM(`money`) FROM `cards` WHERE `loai` = ? AND `create_at` = ?';
		return $this->pdo_query_values($sql,$loai,$days);
	}
	// Tổng số thành viên
	function countMember($key = ''){
		if ($key ==  'products') {
			return $this->pdo_query_values('SELECT COUNT(*) FROM `products`');
		}
		else{
			return $this->pdo_query_values('SELECT COUNT(*) FROM `accounts`');
		}

	}
	//  lấy thông tin setting web
	function infoSettingWeb(){
		return $this->pdo_query_one('SELECT * FROM `settings`');
	}
	// update lại setting 
	function updateSetting($link,$kmtc,$kmatm,$status,$notice,$sttnoti,$phone,$cuphap,$zalo,$support,$diem,$noticehome){
		$sql='UPDATE `settings` SET `thongtin_home` = ? , `facebook_links` = ?, `km_thecao` = ?, `km_bank_momo` = ?, `trangthai` = ? ,`notice` = ?, `status_notice` = ? ,`phone` = ?,`cuphap` = ?,`zalo_links` = ? , `support` = ? , `diem` = ?';
		$this->pdo_execute($sql,$noticehome,$link,$kmtc,$kmatm,$status,$notice,$sttnoti,$phone,$cuphap,$zalo,$support,$diem);
	}
	// upload hình ảnh 
	function upload_images($link){
		$sql='INSERT INTO `images`(`links`) VALUES(?)';
		$this->pdo_execute($sql,$link);
	}
	// lấy danh sách hình ảnh 
	function list_images(){
		return $this->pdo_query('SELECT * FROM `images` order by `id` desc');
	}
	// lấy thông tin 
	function info_images($id){
		$sql='SELECT * FROM `images` WHERE `id` = ?';
		return $this->pdo_query_one($sql,$id);
	}
	// xóa hình ảnh
	function delete_images($id){
		$sql='DELETE FROM `images` WHERE `id` = ?';
		$this->pdo_execute($sql,$id);
	}
	// Thêm game list
	function add_game_list($name,$slug,$rank){
		$sql='INSERT INTO `gamelist`(`name`,`slug`,`loairank`) VALUES(?,?,?)';
		$this->pdo_execute($sql,$name,$slug,$rank);
	}
	// Check slug 
	function check_gamelist_slug($slug,$rule=''){
		if ($rule == '') {
			$sql='SELECT * FROM `gamelist` WHERE `slug` = ?';
		}else{
			$sql='SELECT * FROM `gamelist` WHERE `id` = ?';
		}
		return $this->pdo_query_one($sql,$slug);
	}
	// Lấy rank 
	function rank_list($loai,$rule=''){
		if ($rule == '') {
			$sql = 'SELECT * FROM `ranknews` WHERE `loai` = ? ORDER BY `id` DESC';
			
			return $this->pdo_query($sql,$loai);
		}else{
			$sql='SELECT * FROM `ranknews` WHERE `id` = ?';
			return $this->pdo_query_one($sql,$loai);
		}
	}
	// check categogries
	function check_cate_id($id,$rule=''){
		if ($rule == '') {
			$sql='SELECT * FROM `categogries` WHERE `id` = ?';
		}else{
			$sql='SELECT * FROM `categogries` WHERE `slug` = ?';

		}
		return $this->pdo_query_one($sql,$id);
	}
	function checkCateHack($id,$theloai){
		$sql='SELECT * FROM `categogries` WHERE `id` = ? AND `theloai` != ?';
		return $this->pdo_query_one($sql,$id,$theloai);
	}
	//upload hack
	function uploadHack($name,$content,$images,$cate,$video,$main,$back,$huongdan){
		$sql='INSERT INTO `list_hack`(`name`,`content`,`images`,`cate_id`,`status`,`video`,`link_download`,`back_link_download`,`huongdan`) VALUES(?,?,?,?,0,?,?,?,?)';
		$this->pdo_execute($sql,$name,$content,$images,$cate,$video,$main,$back,$huongdan);
	}
		//update hack
	function updateHack($name,$content,$images,$cate,$video,$status,$id,$main,$back,$huongdan){
		$sql='UPDATE `list_hack` SET `name` = ?, `content` = ?,`images` = ? ,`cate_id` = ?,`status` = ?, `video` = ?,`link_download` = ?, `back_link_download` = ?, `huongdan` = ? WHERE `id` = ?';
		$this->pdo_execute($sql,$name,$content,$images,$cate,$status,$video,$main,$back,$huongdan,$id);
	}
	// xóa bản hack
	function deleteHack($id){
		$sql='DELETE FROM `list_hack` WHERE `id` = ?';
		$this->pdo_execute($sql,$id);
	}
	function getListHackGameByID($id){
		$sql='SELECT * FROM `list_hack` WHERE `cate_id` = ?';
		return $this->pdo_query($sql,$id);
	}
	// list hack
	function listHackGame($id=''){
		if ($id == '') {
			$sql='SELECT * FROM `list_hack`';
			return $this->pdo_query($sql);
		}else{
			$sql='SELECT * FROM `list_hack` WHERE `id` = ?';
			return $this->pdo_query_one($sql,$id);
		}
	}
	// add cate
	function add_cate($name,$slug,$images,$gamelist_id,$theloai,$content){
		$sql='INSERT INTO `categogries`(`name`,`slug`,`images`,`gamelist_id`,`theloai`,`content`) VALUES(?, ?, ?, ?, ?,?)';
		$this->pdo_execute($sql,$name,$slug,$images,$gamelist_id,$theloai,$content);
	}
	// xóa gamelist
	function deleteGame($id){
		$sql='DELETE FROM `gamelist` WHERE `id` = ?';
		$this->pdo_execute($sql,$id);

	}
		// xóa cate
	function deleteCate($id){
		$sql='DELETE FROM `categogries` WHERE `id` = ?';
		$this->pdo_execute($sql,$id);

	}
		// Check slug 

	function gameList(){
		$sql='SELECT * FROM `gamelist`';
		return $this->pdo_query($sql);
	}
			// Check slug 

	function categogriesList($loai=''){
		if ($loai == '') {
			$sql='SELECT * FROM `categogries`';
			return $this->pdo_query($sql);
		}else{
			$sql='SELECT * FROM `categogries` WHERE `theloai` != ? ';
			return $this->pdo_query($sql,$loai);
		}
	}
// update thông tin gamelist
	function update_game($name,$slug,$status,$sapxep,$rank,$id){
		$sql='UPDATE `gamelist` SET `name` = ? , `slug` = ? ,`status` = ? , `sapxep` = ?,`loairank` = ? WHERE `id` = ?';
		$this->pdo_execute($sql,$name,$slug,$status,$sapxep,$rank,$id);
	}
	// update thông tin gamelist
	function update_cate($name,$slug,$status,$sapxep,$hinhanh,$game_id,$noidung,$id){
		$sql='UPDATE `categogries` SET `name` = ? , `slug` = ? ,`status` = ? , `sapxep` = ?,`images` = ?, `gamelist_id` = ?, `content` = ? WHERE `id` = ?';
		$this->pdo_execute($sql,$name,$slug,$status,$sapxep,$hinhanh,$game_id,$noidung,$id);
	}
	// Tạo slug
	function to_slug($str) {
		$str = trim(mb_strtolower($str));
		$str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
		$str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
		$str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
		$str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
		$str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
		$str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
		$str = preg_replace('/(đ)/', 'd', $str);
		$str = preg_replace('/[^a-z0-9-\s]/', '', $str);
		$str = preg_replace('/([\s]+)/', '-', $str);
		return $str;
	}
	// add products 
	function add_products($taikhoan,$matkhau,$price,$images,$list_images,$info,$level,$skin,$ranks,$champs,$cate_id,$rp,$lienket){
		$sql='INSERT INTO `products`(`taikhoan`,`password`,`price`,`images`,`images_list`,`info`,`level`,`skin`,`ranks`,`champs`,`cate_id`,`rp`,`lienket`) VALUES(?, ?, ?, ?, ?,?, ?,?,?,?,?,?,?)';
		$this->pdo_execute($sql,$taikhoan,$matkhau,$price,$images,$list_images,$info,$level,$skin,$ranks,$champs,$cate_id,$rp,$lienket);
	}
	// show list acc
	function list_account_cate($cate_id){
		$sql='SELECT * FROM `products` WHERE `cate_id` = ?';
		return $this->pdo_query($sql,$cate_id);
	}
	// check product

	function check_product($id){
		$sql='SELECT * FROM `products` WHERE `id` = ?';
		return $this->pdo_query_one($sql,$id);
	}
	// xóa product
	function delete_product($id){
		$sql='DELETE FROM `products` WHERE `id` = ?';
		return $this->pdo_query($sql,$id);
	}
	// Thêm ngân hàng 
	function add_payment($nganhang,$img,$chuthe,$stk){
		$sql='INSERT INTO `banks`(`nganhang`,`images`,`chuthe`,`stk`) VALUES(?,?,?,?)';
		$this->pdo_execute($sql,$nganhang,$img,$chuthe,$stk);
	}
	// List bank 
	function list_banks(){
		return $this->pdo_query('SELECT * FROM `banks`');
	}
		// xóa bank
	function delete_bank($id){
		$sql='DELETE FROM `banks` WHERE `id` = ?';
		$this->pdo_execute($sql,$id);
	}
			// check payment
	function check_payment($id){
		$sql='SELECT * FROM `banks` WHERE `id` = ?';
		return $this->pdo_query_one($sql,$id);
	}
	// Danh sách người dùng
	function list_user(){
		return $this->pdo_query('SELECT * FROM `accounts`');
	}
	// lock user
	function lock_user($status,$id){
		$sql='UPDATE `accounts` SET `status` = ? WHERE `id` = ?';
		$this->pdo_execute($sql,$status,$id);
	}
	// cộng trừ tiền
	function congtru($id,$sotien,$loai,$transid,$messages,$status,$create){
		if ($loai == 0) {
			$sql='UPDATE `accounts` SET `coin` = `coin` + ? WHERE `id` = ?';
			$type = 'admin';
			$some = $status;
			$noidung = 'Admin đã cộng: '.number_format($sotien).' vnđ cho tài khoản: #'.$id;
		// Ghi vào lịch sử 				
		}else{
			$sql ='UPDATE `accounts` SET `coin` = `coin` - ? WHERE `id` = ?';
			$type = 'trutien';
			$some = 3;
			$noidung = 'Admin đã trừ: '.number_format($sotien).' vnđ của tài khoản: #'.$id;

		}
		$sql2 = 'INSERT INTO `cards`(`trans_id`,`username`,`money`,`messages`,`status`,`create_at`,`type`,`loai`) VALUES(?,?,?,?,?,?,?,?)';
		$sql3 = 'INSERT INTO `admin_history`(`noidung`) VALUES(?)';
		$this->pdo_execute($sql3,$noidung);
		$this->pdo_execute($sql,$sotien,$id);
		$this->pdo_execute($sql2,$transid,$id,$sotien,$messages,$some,$create,$type,$type);
	}
	// list card
	function list_card(){
		return $this->pdo_query('SELECT * FROM `cards`');
	}
	// addmin history
	function admin_history(){
		return $this->pdo_query('SELECT * FROM `admin_history` ORDER BY  `id` DESC');
	}
}
?>