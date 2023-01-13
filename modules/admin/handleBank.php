<?php 

/**
 * 
 */
class handleBank extends classFuncAdmin
{
	/*
	KHU VỰC SỬ DUNG CHUNG
	 */
	// duyệt tay giao dịch
	function duyetTay($id,$money){
		// lấy thông tin giao dịch
		$sms = 0;
		$sql='SELECT * FROM `banks_his` WHERE `id` = ? AND `status` = 0';
		$info = $this->pdo_query_one($sql,$id);
		if (!$info) {
			// code...
			$sms = -999; // không tìm thấy hoặc đã được duyệt
		}else if($money < 0){
			$sms =  -1000;
		}else{
		// cộng tiền cho user ngay
			$sql_update = 'UPDATE `banks_his` SET `amount` = ? , `status` = 1 WHERE `id` = ?';
			$res_u = $this->pdo_execute($sql_update,$money,$id);
			if ($res_u == '') {
				$sql2 = 'UPDATE `accounts` SET `coin` = `coin` + ? WHERE `id` = ?';
				$res_2 = $this->pdo_execute($sql2,$money,$info['user_id']);
				if ($res_2 == '') {
					$sms = 999;
				}else{
					$sms = -655; // không thể cộng tiền cho người dùng
				}
			}else{
				$sms = -4542; // không thể update giao dịch
				// update 
			}
		}
		return $sms;
	}
	// lấy lịch sử giao dịch bank
	function listHistoryAllBank(){
		$sql='SELECT * FROM `banks_his`';
		return $this->pdo_query($sql);
		// active bank
	}
	function activeBank($id){
		// check bank
		$info = $this->checkBankById($id);
		$sms = 0;
		if ($info) {
			if ($info['status'] == 1) {
			$sms = -89; // mã đã được kích hoạt rồi cha
		}else{
				// tìm thấy người dùng rồi giờ phải làm sao ? 

			switch ($info['bank_name']) {
				// bắt đầu
				case 'tpbank':
				$reuslt_logintp = $this->loginTpBank($info['id']);				

				switch ($reuslt_logintp) {
					case -32123:
					$sms = -32123; // không thể lấy token nè
					break;
					case -99:
					$sms = -99; // mã lỗi hệ thống
					break;
					case -9999:
					$sms = -9999; // mã lỗi sai tài khoản hoặc mật khẩu
					break;
					default:
					$runner = $this->updateAuth($id,$reuslt_logintp);
					if ($runner == true) {
						$sms = 99; // thành công
					}else{
						$sms = -9000; // mã lỗi khi không thể update 
					}
					break;
				}
				break;
				case 'momo':
				$token = 'f-'.$this->get_TOKEN(); // get token
				$imei = $this->generateImei(); // imei
				$modelid = $this->generateImei(); // modelid
				$rkey = $this->generateRandom(20);
				$device_token = $this->generateRandom(64);
				$result_checkUser = $this->checkUserMomo($info['username'],$imei);

				if ($result_checkUser['errorCode'] == 0) {
					
					// update imeivào  thông tin người dùng nào :3
					$sql_update_imei = 'UPDATE `banks` SET `imei` = ? WHERE `id` = ?';
					$done_sui = $this->pdo_execute($sql_update_imei,$imei,$info['id']);
					if ($done_sui != '') {
						$sms = -85443; // mã lỗi không thể cập nhật thông tin
					}else{
						$result_loginmomo = $this->getOtpMomo($info['username'],$token,$imei,$modelid,$rkey,$device_token);
					// 	// print_r($result_loginmomo);
					// 	if ($result_loginmomo['errorCode'] != -290) {
					// // UPDATE THÔNG TIN
					// 		$sql = 'UPDATE `banks` SET `token` = ? , `modelid` = ?, `rkey` = ? ,`device_token` = ? WHERE `id` = ?';
					// 		$result_sql = $this->pdo_execute($sql,$token,$modelid,$rkey,$device_token,$info['id']);
					// 		if ($result_sql == '') {
					// 			$sms = 93812;
					// 		}else{
					// 			$sms = -9993;
					// 		}
					// 	}else{
					// 		$sms = -9932;
					// 	}
$sms = $result_loginmomo;
					}
				}else{
					$sms = -87554; // mã lỗi không thể xác minh người dùng
				}

				break;
// xử lý 
				default:
				$sms = -8787; // mã lỗi không hỗ trợ ngân hàng trên 
				break;
			}
		}
	}else{
		$sms = -483834834; // mã lỗi không tìm thấy thông tin
	}
	return $sms;
}
	/*
	
	-----------KHU VỰC XỬ LÝ AUTO MOMO ---------------------------

	 */


	public $listActionMomo = array(
		'appVer' => 40114,
		'appCode' => '4.0.11',
		'appId' => 'vn.momo.platform',
		'cname' => 'Vietnam',
		'ccode' => '084',
		'device' => 'iPhone14',
		'firmware' => '15.6.1',
		'hardware' => 'iPhone',
		'manufacture' => 'Apple',
		'device_os' => 'ios',
		'mcc' => '452',
		'mnc' => '02',
		'deviceOS' => 'ios',
		// HỦY THIẾT BỊ
		'REG_DEVICE_MSG' => array(
			'domain' => 'https://api.momo.vn/backend/otp-app/public/REG_DEVICE_MSG',
			'class' => 'mservice.backend.entity.msg.RegDeviceMsg'
		),
		// lấy mã otp 
		'SEND_OTP_MSG' =>  array(
			'domain' => 'https://api.momo.vn/backend/otp-app/public/SEND_OTP_MSG',
			'class' => 'mservice.backend.entity.msg.RegDeviceMsg'
		),
		//  đăng nhập người dùng
		'USER_LOGIN_MSG' =>  array(
			'domain' => 'https://owa.momo.vn/public/login',
			'class' => 'mservice.backend.entity.msg.LoginMsg'
		),
		// KIỂM TRA USER 
		'CHECK_USER_BE_MSG' =>  array(
			'domain' => 'https://api.momo.vn/backend/auth-app/public/CHECK_USER_BE_MSG',
			'class' => 'mservice.backend.entity.msg.RegDeviceMsg'
		),
		'TRANHIS_BROWER' => array(
			'domain' => 'https://api.momo.vn/sync/transhis/browse',
			'class' => '' 
		),
		'TRANHIS_DETAIL' => array(
			'domain' => 'https://api.momo.vn/sync/transhis/details',
			'class' => ''
		)

	);
	public function getTransactionMOMO($id){
		// check bank
		$info = $this->checkBankById($id);
		$sms = 0;
		if ($info) {
			$action = 'TRANHIS_BROWER';
			// tạo request key
			$requestkeyRaw = $this->generateRandom(32); // tạo keyRaw với 32 ký tự
			$requestkey = $this->RSA_Encrypt($info['REQUEST_ENCRYPT_KEY'],$requestkeyRaw);
			// kết thúc
			$header = array(
				'Host: api.momo.vn',
				'app_code: '.$this->listActionMomo['appCode'],
				'lang: vi',
				'user-agent: Ktor client',
				'app_version: '.$this->listActionMomo['appVer'],
				'channel: APP',
				'requestkey: '.$requestkey,
				'authorization: '.$info['authorization'],
				'accept-language: vi-VN,vi;q=0.9',
				'device_os: '.$this->listActionMomo['device_os'],
				'accept-charset: UTF-8',
				'accept: application/json',
				'content-type: application/json',
				'agent_id: 0'
			);
			$startTime = (time() - 86400) *1000;
			$endTime = time()*1000;
			$data  = array(
				"requestId" =>  $requestkey,
				"offset" =>  0,
				"limit" =>  20,
				"startDate" =>  $startTime,
				"endDate" =>  $endTime,
			);
			$data_encode = $this->Encrypt_data($data,$requestkeyRaw);
			$curl_ = $this->CURL_MOMO($action,$data_encode,$header,$requestkeyRaw);
			$sms = $curl_;
		}
		return $sms;
	}
	public function getDetailsTransactionMOMO($id,$transid){
			// check bank
		$info = $this->checkBankById($id);
		$sms = 0;
		if ($info) {
			$action = 'TRANHIS_DETAIL';
			// tạo request key
			$requestkeyRaw = $this->generateRandom(32); // tạo keyRaw với 32 ký tự
			$requestkey = $this->RSA_Encrypt($info['REQUEST_ENCRYPT_KEY'],$requestkeyRaw);
			// kết thúc
			$header = array(
				'Host: api.momo.vn',
				'app_code: '.$this->listActionMomo['appCode'],
				'lang: vi',
				'user-agent: Ktor client',
				'app_version: '.$this->listActionMomo['appVer'],
				'channel: APP',
				'requestkey: '.$requestkey,
				'authorization: '.$info['authorization'],
				'accept-language: vi-VN,vi;q=0.9',
				'device_os: '.$this->listActionMomo['device_os'],
				'accept-charset: UTF-8',
				'accept: application/json',
				'content-type: application/json',
				'agent_id: 0'
			);
			$data  = array(
				"requestId" =>  $requestkey,
				"transId" =>  $transid,
				"username" =>  $info['username'],
			);
			$data_encode = $this->Encrypt_data($data,$requestkeyRaw);
			$curl_ = $this->CURL_MOMO($action,$data_encode,$header,$requestkeyRaw);
			$sms = $curl_;
			if ($curl_['resultCode'] != 0) {
				// code...
				$sms = -9322;
			}else{
				$sms = $curl_;
			}
		}
		return $sms;

	}
	public function resetAuth($id){
		$info = $this->checkBankById($id);
		$sms = 0;
		if ($info) {
			$password = $this->Decrypt_data($info['password'],KEY_HASH);
			$ulm_ = $this->USER_LOGIN_MSG($info['username'],$password,$info['imei'],$info['token'],$info['device_token'],$info['modelid'],$info['setupKey'],$info['oHash']);
			if ($ulm_['errorCode'] == 0) {
				$time_express = date('Y-m-d H:i:s',  (time() + 900) );
				$sql_update_done = 'UPDATE `banks` SET `expires` = ?, `pHash` = ?,  `REQUEST_ENCRYPT_KEY` = ? ,`sessionkey` = ?, `authorization` = ? WHERE `id` = ?';
				$data_get  = array(
					'pHash' => $ulm_['extra']['pHash'],
					'REQUEST_ENCRYPT_KEY' => $ulm_['extra']['REQUEST_ENCRYPT_KEY'],
					'SESSION_KEY' => $ulm_['extra']['SESSION_KEY'],
					'AUTH_TOKEN' => 'Bearer '.$ulm_['extra']['AUTH_TOKEN']
				);
				$runder = $this->pdo_execute($sql_update_done,$time_express,$data_get['pHash'],$data_get['REQUEST_ENCRYPT_KEY'],$data_get['SESSION_KEY'],$data_get['AUTH_TOKEN'],$info['id']);
				if ($runder == '') {
					$sms = 99;
				}else{
					$sms = -904333;
				}
			}else{
				$unActiver = $this->unActiveBank($info['id']);
				if ($unActiver == 99) {
					$sms = -944346;

				}else{

					$sms = -944345;
				}
			}
		}
		return $sms;
	}
	public function importOtp($otp,$id){
	// check bank
		$info = $this->checkBankById($id);
		$sms = 0;
		if ($info) {
			if ($info['status'] == 1) {
			$sms = -89; // mã đã được kích hoạt rồi cha
		}else{
			$ohash = hash('sha256',$info['username'].$info['rkey'].$otp);
			$rdm_ = $this->REG_DEVICE_MSG($ohash,$info['username'],$info['rkey'],$info['token'],$info['device_token'],$info['imei'],$info['modelid']);
			if ($rdm_['errorCode'] == 0) {
				$setupKey = $rdm_['extra']['setupKey'];
				$ohash = $rdm_['extra']['ohash'];

				$sql_UPDATE = 'UPDATE `banks` SET `oHash` = ? ,`setupKey` = ? WHERE `id` = ?';
				$result_su = $this->pdo_execute($sql_UPDATE,$ohash,$setupKey,$info['id']);
				if ($result_su == '') {
					// tạo biến gọi lại thông tin
					$reInfo = $this->checkBankById($id);
					$passwordH = $this->Decrypt_data($reInfo['password'],KEY_HASH);
					$ulm_ = $this->USER_LOGIN_MSG($reInfo['username'],$passwordH,$reInfo['imei'],$reInfo['token'],$reInfo['device_token'],$reInfo['modelid'],$reInfo['setupKey'],$reInfo['oHash']);
					if ($ulm_['errorCode'] == 0) {
						$sql_update_done = 'UPDATE `banks` SET `expires` = ?,  `pHash` = ?,  `REQUEST_ENCRYPT_KEY` = ? ,`sessionkey` = ?, `authorization` = ?,`status` = 1 WHERE `id` = ?';
						$time_express = date('Y-m-d H:i:s',  (time() + 900) );
						$data_get  = array(
							'pHash' => $ulm_['extra']['pHash'],
							'REQUEST_ENCRYPT_KEY' => $ulm_['extra']['REQUEST_ENCRYPT_KEY'],
							'SESSION_KEY' => $ulm_['extra']['SESSION_KEY'],
							'AUTH_TOKEN' => 'Bearer '.$ulm_['extra']['AUTH_TOKEN']
						);
						$runder = $this->pdo_execute($sql_update_done,$time_express,$data_get['pHash'],$data_get['REQUEST_ENCRYPT_KEY'],$data_get['SESSION_KEY'],$data_get['AUTH_TOKEN'],$reInfo['id']);
						if ($runder == '') {
							$sms = 32213232; // thành công
						}else{
							$sms = -32123; // mã lỗi hệ thống đối với login
						}
					}else{
						$sms = -944332; // mã lỗi không thể đăng nhập 
					}
				}else{
					$sms = -14323; // mã lỗi không thể cập nhật hệ thống
				}
			}else{
				$sms = -2135553; // mã lỗi OTP không chính xác vui lòng nhập lại
			}
		}
	}
	return $sms;
}
function USER_LOGIN_MSG($user,$pass,$imei,$token,$device_token,$modelid,$setupKey,$ohash){
					$phash = $this->get_pHash($imei,$pass,$setupKey,$ohash); // mã hóa password

					$action = 'USER_LOGIN_MSG';
			// hash otp 
					$data = array(
						"user" => $user,
						"pass" => $pass,
						"msgType" => $action,
						"momoMsg" => array(
							"_class" => $this->listActionMomo[$action]['class'],
							"isSetup" => false
						),
						"extra" => array(
							"pHash" => $phash,
							"IDFA" => "",
							"SIMULATOR" => false,
							"TOKEN" => $token,
							"ONESIGNAL_TOKEN" => $token,
							"SECUREID" => "",
							"MODELID" => $modelid,
							"DEVICE_TOKEN" => $device_token,
						),
						"appVer" => $this->listActionMomo['appVer'],
						"appCode" => $this->listActionMomo['appCode'],
						"lang" => "vi",
						"deviceOS" => $this->listActionMomo['deviceOS'],
						"channel" => "APP",
						"buildNumber" => 0,
						"appId" =>  $this->listActionMomo['appId'],
						"cmdId" => $this->get_microtime()."000000",
						"time" => $this->get_microtime()
					);
					$header = array(
						'Host: owa.momo.vn',
						'sessionkey: ',
						'userid: '.$user,
						'msgtype: '.$action,
						'user_phone: '.$user,
						'app_code: '.$this->listActionMomo['appCode'],
						'lang: vi',
						'sessionkey_v2: ',
						'app_version: '.$this->listActionMomo['appVer'],
						'user-agent: Ktor client',
						'channel: APP',
						'accept-language: vi-VN,vi;q=0.9',
						'device_os: IOS',
						'accept-charset: UTF-8',
						'accept: application/json',
						'content-type: application/json',
						'agent_id: 0'
					);


					$curl_ = $this->CURL_MOMO($action,$data,$header);
					return $curl_;
				}
				function REG_DEVICE_MSG($ohash,$user,$rkey,$token,$device_token,$imei,$modelid){
					$action = 'REG_DEVICE_MSG';
			// hash otp 
					$data = array(
						"user" => $user,
						"msgType" => $action,
						"momoMsg" => array(
							"_class" => $this->listActionMomo[$action]['class'],
							"number" => $user,
							"imei" => $imei,
							"cname" => $this->listActionMomo['cname'],
							"ccode" => $this->listActionMomo['ccode'],
							"device" => $this->listActionMomo['device'],
							"firmware" => $this->listActionMomo['firmware'],
							"hardware" => $this->listActionMomo['hardware'],
							"manufacture" =>  $this->listActionMomo['manufacture'],
							"csp" => "",
							"icc" => "",
							"mcc" => $this->listActionMomo['mcc'],
							"mnc" => $this->listActionMomo['mnc'],
							"device_os" =>  $this->listActionMomo['device_os'],
							"secure_id" => ""
						),
						"extra" => array(
							"ohash" => $ohash,
							"IDFA" => "",
							"SIMULATOR" => false,
							"TOKEN" => $token,
							"ONESIGNAL_TOKEN" => $token,
							"SECUREID" => "",
							"MODELID" => $modelid,
							"DEVICE_TOKEN" => $device_token,
							"isVoice" => false,
							"REQUIRE_HASH_STRING_OTP" => true
						),
						"appVer" => $this->listActionMomo['appVer'],
						"appCode" => $this->listActionMomo['appCode'],
						"lang" => "vi",
						"deviceOS" => $this->listActionMomo['deviceOS'],
						"channel" => "APP",
						"buildNumber" => 0,
						"appId" =>  $this->listActionMomo['appId'],
						"cmdId" => $this->get_microtime()."000000",
						"time" => $this->get_microtime()
					);
					$header = array(
						'Host: api.momo.vn',
						'sessionkey: ',
						'userid: ',
						'msgtype: '.$action,
						'user_phone: ',
						'app_code: '.$this->listActionMomo['appCode'],
						'lang: vi',
						'sessionkey_v2: ',
						'app_version: '.$this->listActionMomo['appVer'],
						'user-agent: Ktor client',
						'channel: APP',
						'accept-language: vi-VN,vi;q=0.9',
						'device_os: IOS',
						'accept-charset: UTF-8',
						'accept: application/json',
						'content-type: application/json',
						'agent_id: 0'
					);

					$curl_ = $this->CURL_MOMO($action,$data,$header);
					return $curl_;
				}
				function checkUserMomo($user,$imei){

			$action = 'CHECK_USER_BE_MSG'; // gửi otp
			$data = array(
				"user" => $user,
				"msgType" => $action,
				"momoMsg" => array(
					"_class" => $this->listActionMomo[$action]['class'],
					"number" => $user,
					"imei" => $imei,
					"cname" => $this->listActionMomo['cname'],
					"ccode" => $this->listActionMomo['ccode'],
					"device" => $this->listActionMomo['device'],
					"firmware" => $this->listActionMomo['firmware'],
					"hardware" => $this->listActionMomo['hardware'],
					"manufacture" =>  $this->listActionMomo['manufacture'],
					"csp" => "",
					"icc" => "",
					"mcc" => $this->listActionMomo['mcc'],
					"mnc" => $this->listActionMomo['mnc'],
					"device_os" =>  $this->listActionMomo['device_os'],
					"secure_id" => ""
				),
				"appVer" => $this->listActionMomo['appVer'],
				"appCode" => $this->listActionMomo['appCode'],
				"lang" => "vi",
				"deviceOS" => $this->listActionMomo['deviceOS'],
				"channel" => "APP",
				"buildNumber" => 0,
				"appId" =>  $this->listActionMomo['appId'],
				"cmdId" => $this->get_microtime()."000000",
				"time" => $this->get_microtime()
			);
			$header = array(
				'Host: api.momo.vn',
				'sessionkey: ',
				'userid: ',
				'msgtype: '.$action,
				'user_phone: ',
				'app_code: '.$this->listActionMomo['appCode'],
				'lang: vi',
				'sessionkey_v2: ',
				'app_version: '.$this->listActionMomo['appVer'],
				'user-agent: Ktor client',
				'channel: APP',
				'accept-language: vi-VN,vi;q=0.9',
				'device_os: IOS',
				'accept-charset: UTF-8',
				'accept: application/json',
				'content-type: application/json',
				'agent_id: 0'
			);

			$curl_ = $this->CURL_MOMO($action,$data,$header);
			return $curl_;
		}
		function getOtpMomo($user,$token,$imei,$modelid,$rkey,$device_token){
			$action = 'SEND_OTP_MSG'; // gửi otp

			$data = array(
				"user" => $user,
				"msgType" => $action,
				"momoMsg" => array(
					"_class" => $this->listActionMomo[$action]['class'],
					"number" => $user,
					"imei" => $imei,
					"cname" => $this->listActionMomo['cname'],
					"ccode" => $this->listActionMomo['ccode'],
					"device" => $this->listActionMomo['device'],
					"firmware" => $this->listActionMomo['firmware'],
					"hardware" => $this->listActionMomo['hardware'],
					"manufacture" =>  $this->listActionMomo['manufacture'],
					"csp" => "",
					"icc" => "",
					"mcc" => $this->listActionMomo['mcc'],
					"mnc" => $this->listActionMomo['mnc'],
					"device_os" =>  $this->listActionMomo['device_os'],
					"secure_id" => ""
				),
				"extra" => array(
					"action" => "SEND",
					"rkey" => $rkey,
					"IDFA" => "",
					"SIMULATOR" => false,
					"TOKEN" => $token,
					"ONESIGNAL_TOKEN" => $token,
					"SECUREID" => "",
					"MODELID" => $modelid,
					"DEVICE_TOKEN" => $device_token,
					"isVoice" => false,
					"REQUIRE_HASH_STRING_OTP" => true
				),
				"appVer" => $this->listActionMomo['appVer'],
				"appCode" => $this->listActionMomo['appCode'],
				"lang" => "vi",
				"deviceOS" => "ios",
				"channel" => "APP",
				"buildNumber" => 0,
				"appId" => $this->listActionMomo['appId'],
				"cmdId" => $this->get_microtime()."000000",
				"time" => $this->get_microtime() 
			);
			$header = array(
				'Host: api.momo.vn',
				'sessionkey: ',
				'userid: ',
				'msgtype: '.$action,
				'user_phone: ',
				'app_code: '.$this->listActionMomo['appCode'],
				'lang: vi',
				'sessionkey_v2: ',
				'app_version: '.$this->listActionMomo['appVer'],
				'user-agent: Ktor client',
				'channel: APP',
				'accept-language: vi-VN,vi;q=0.9',
				'device_os: IOS',
				'accept-charset: UTF-8',
				'accept: application/json',
				'content-type: application/json',
				'agent_id: 0'
			);
			$curl_ = $this->CURL_MOMO($action,$data,$header);
			return $curl_;
		}
		private function get_pHash($imei,$password,$setupKey,$ohash)
		{
			// đầu tiên phải lấy key được decode từ ohash đã
			$ohash_decode = $this->Decrypt_data($setupKey,$ohash);
			$data = $imei."|".$password;
			$iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
			return base64_encode(openssl_encrypt($data, 'AES-256-CBC',$ohash_decode, OPENSSL_RAW_DATA, $iv));
		}
		private function generateRandom($length = 20)
		{
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}
		private function generateRandomString($length = 20)
		{
			$characters = '0123456789abcdef';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}

		public function generateImei()
		{
			return $this->generateRandomString(8) . '-' . $this->generateRandomString(4) . '-' . $this->generateRandomString(4) . '-' . $this->generateRandomString(4) . '-' . $this->generateRandomString(12);
		}
		public function get_microtime()
		{
			return round(microtime(true) * 1000);
		}
		function INCLUDE_RSA($key)
		{
			$rsa = new Crypt_RSA();
			$rsa->loadKey($key);
			$rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
			return $rsa;
		}
		private function get_TOKEN()
		{
			return  $this->generateRandom(22).':'.$this->generateRandom(9).'-'.$this->generateRandom(20).'-'.$this->generateRandom(12).'-'.$this->generateRandom(7).'-'.$this->generateRandom(7).'-'.$this->generateRandom(53).'-'.$this->generateRandom(9).'_'.$this->generateRandom(11).'-'.$this->generateRandom(4);
		}
		function Decrypt_data($data,$key)
		{

			$iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
			return openssl_decrypt(base64_decode($data), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);

		}
		public function Encrypt_data($data,$key)
		{

			$iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
			return base64_encode(openssl_encrypt(is_array($data) ? json_encode($data) : $data, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));

		}
		public function RSA_Encrypt($key,$content)
		{
			$rsa = $this->INCLUDE_RSA($key);

			return base64_encode($rsa->encrypt($content));
		}

		public function CURL_MOMO($action,$data,$header,$key=''){
			$url = $this->listActionMomo[$action]['domain'];

			$curl = curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => ($key =='') ? json_encode($data) : $data,
				CURLOPT_HTTPHEADER => $header
			));

			$response = curl_exec($curl);

			curl_close($curl);

			if (is_object(json_decode($response))) {
				return  json_decode($response,true);
			}else{
				return json_decode($this->Decrypt_data($response,$key),true);
			}
		}

	/*
	----------- KHU VỰC BÊN DƯỚI LÀ XỬ LÝ AUTO TP BANK BY QUYỀN.DEV ------------

	 */
	// get list bank chưa được xử lý
	function listBankHisByBrandStatus($brand,$status=0){
		$sql='SELECT * FROM `banks_his` WHERE `brand` = ? AND `status` = ?';
		return $this->pdo_query($sql,$brand,$status);
	}
	// xử lý nạp tiền 
	function curlAutoCheckBankHis($transid,$amount=0,$brand){
		$sql='SELECT * FROM `banks_his` WHERE `trans_id` = ? AND `brand` = ?';
		$result = $this->pdo_query_one($sql,$transid,$brand);
		$sms = '[ "'.$transid.' " ] - Không tồn tại mã giao dịch trên hệ thống ⛔';
		// kiểm tra đã xử lý thanh toán đó chưa
		if ($result) {
			if ($result['status'] == 1) {
				// code...
				$sms = '<strong class="badge bg-primary">'.$result['trans_id'].'</strong> - Ngân hàng: '.strtoupper($result['brand']).' đã được xử lý trước đó 📛';
			}else{
				// cộng tiền cho user ngay
				$sql_update = 'UPDATE `banks_his` SET `amount` = ? , `status` = 1 WHERE `id` = ?';
				$res_u = $this->pdo_execute($sql_update,$amount,$result['id']);
				if ($res_u == '') {
					$sql2 = 'UPDATE `accounts` SET `coin` = `coin` + ? WHERE `id` = ?';
					$res_2 = $this->pdo_execute($sql2,$amount,$result['user_id']);
					if ($res_2 == '') {
						$sms = 'Đã cộng <strong class="text-success">'.number_format($amount).' Đ</strong> cho mã giao dịch: <span class="badge bg-success text-uppercase"> '.$result['trans_id'].' </span> 🔥';
					}
				}
				// update 
			}
		}
		return $sms;
	}
	// lấy danh sách các tài khoản đang chạy
	function getListBanksRun(){
		$sql='SELECT * FROM `banks` WHERE `status` = 1';
		return $this->pdo_query($sql);
	}
	// lấy lịch sử giao dịch
	function getTranscationTPbank($id){
		$info = $this->checkBankById($id);
		$sms = 0;
		if ($info) {
			// code...
			$command = 'smart-search-presentation-service/v1/account-transactions/find';
			$list_bank =  $this->getListAccount($id);
		$date_before = time() - 172800; // lấy lịch sử giao dịch trong 2 ngày
		$date_current = time();
		$date_b_f = date('Ymd',$date_before);
		$date_b_n = date('Ymd',$date_current);
		$data = array(
			'toDate' => $date_b_n,
			'fromDate' => $date_b_f,
			'accountNo' => $list_bank[0]['stk'],
			'currency' => 'VND'
		);
		$sms =  $this->curlTpBank($command,$data,$info['authorization']);
	}
	return $sms;
}
	// lấy danh sách account
function getListAccount($id){
	$info = $this->checkBankById($id);
	$data = array();
	if ($info) {
		$command = 'common-presentation-service/v1/bank-accounts?function=home';
		$result = $this->curlTpBank_GET($command, $info['authorization']);
		foreach ($result as $key => $value) {
			$data[$key]['stk'] = $value->BBAN;
			$data[$key]['sodu'] = number_format($value->availableBalance).' '.$value->currency;
			$data[$key]['name'] = $value->name;
		}
	}
	return  $data;
}

// un active
function unActiveBank($id,$auth=''){
	$info = $this->checkBankById($id);
	$sms = 0;
	if ($info) {
		if ($info['status'] == 0) {
			$sms = -89; // mã đã tắt kích hoạt rồi cha
		}else{
			$sql='UPDATE `banks` SET `authorization` = ?, `status` = 0 WHERE `id` = ?';
			$result = $this->pdo_execute($sql,$auth,$id);
			if ($result == '' ) {
				$sms = 99;
			}else{ 
				$sms = -99;
			}
		}
	}
	return $sms;
}
function updateAuth($id,$access_token){
	$expires = 900; // 15 phút 
	$timehandle = time() + $expires;
	$time_format =  date('Y-m-d H:i:s', $timehandle);
	$sql = 'UPDATE `banks` SET `authorization` = ? ,`expires` = ? ,`status` = 1 WHERE `id` = ?';
	$result = $this->pdo_execute($sql,$access_token,$time_format,$id);
	$sms = false;
	if ($reuslt == '') {
		$sms = true;
	}else{
		$sms = false;
	}
	return $sms;
	// 
}
function delBankAccountById($id){
		$sms = 0; // mã lỗi không có hành động
		$sql='SELECT * FROM `banks` WHERE `id` = ?';
		$info =  $this->pdo_query_one($sql,$id);
		if (!$info) {
			// code...
			$sms = 1; // không tìm thấy người dùng
		}else{
			$sql_2 = 'DELETE FROM `banks` WHERE `id` = ?';
			$res_ = $this->pdo_execute($sql_2,$id);
			if ($res_ == '') {
				$sms = 99; // thành công
			}else{

				$sms = -1; // lỗi mã nguồn
			}
		}
		return $sms;
	}
	// curl TPBANK
	public $configTbBank = array(
		'PLATFORM_NAME' => 'iOS',
		'APP_VERSION' => '10.10.95',
		'PLATFORM_VERSION' => '15.6.1',
		'DEVICE_NAME' => 'iphone 14 pro'
	);
	function loginTpBank($id){
		// check user
		$userInfo = $this->checkBankById($id);
		$sms = -99;
		if (!$userInfo) {
			$sms = -99;
		}else{
						// nếu tìm thấy người dùng đó thì bắt đầu call
			$cmd_ = 'auth/login';
			$passwordH = $this->Decrypt_data($userInfo['password'],KEY_HASH);
			$data = array(
				"username" => $userInfo['username'],
				"deviceId"  => $userInfo['device_id'],
				"step_2FA"  => "VERIFY",
				"password"  => $passwordH,
			);
			$reuslt  = $this->curlTpBank($cmd_,$data);
	
			if ($reuslt->error) {
				$error_sms = $reuslt->error->error_message;
				if ($error_sms == 'CAPTCHA_IS_REQUIRED') {
			// 	nó bắt lấy captcha để đăng nhập nè =(( vậy thì phải call để lấy captcha đã
					$callcaptcha = $this->callCaptchaTpBank($userInfo['device_id']);
				// call lại
					$data_new = array(
						"username" => $userInfo['username'],
						"captcha" =>  array(
							"captchaImage"=> $callcaptcha["data"]->captchaImage,
							"clientIP" => $callcaptcha["data"]->clientIP,
							"clientId" => $callcaptcha["data"]->clientId,
							"id" => $callcaptcha["data"]->id,
							"captcha" => $callcaptcha['bypass']
						),
						"step_2FA" => "VERIFY",
						"deviceId" => $userInfo['device_id'],
						"password" => $passwordH,
					);
					$after_error = $this->curlTpBank($cmd_,$data_new);
					if ($after_error->access_token) {
						// code...
						$token = $after_error->token_type.' '.$after_error->access_token;
						$sms = $token;
					}else{
						$sms = -32123;
					}
				}else if($error_sms == 'INVALID_CREDENTIAL_WRONG_AND_HAVE_TRY_NUMBER_REMAINS'){
					$sms = 	-9999;
				}else if($error_sms == 'ACCOUNT_HAVE_LOCKED_BECAUSE_INVALID_CREDENTIAL_OVER'){
					$sms = 	-312223;

				}
			}else{
				$token = $reuslt->token_type.' '.$reuslt->access_token;	
				$sms = $token;
			}
		}
		return $sms;
	}

	// call captcha tpbank
	function callCaptchaTpBank($deviceID){
		$cmd_  = 'common-presentation-service/v1/captcha/generate';
		$data = array("theme" => "light",
			"captcha" => array(
				"clientId" => $deviceID,
				"clientIP" => "10.10.10.10"
			),
		);
		$call_ = $this->curlTpBank($cmd_,$data);
		$captcha_img =  $call_->captcha->captchaImage;
		$explode = explode('data:image/png;base64,', $captcha_img);
		$bypass = $this->bypassCaptcha($explode[1]);
		/////////////////////////////////////////////////////////////////
		return  array("data"=>$call_->captcha, "bypass" => $bypass->result); //
		/////////////////////////////////////////////////////////////////
		
	}
	// check cú pháp nạp
	// check user
	function checkUserBrand($id,$username,$password,$brand,$chuthe,$sotk,$cuphap){
		// đầu tiên là check xem có tài khoản chư
		$sms = 1; // 1 là lỗi - 0 là oke
		$stt_ = $this->getBankConfig($id);
		$sql_1 = 'SELECT * FROM `banks` WHERE `username` = ? AND `bank_name` = ? AND `id_admin` = ?';
		$result_1 = $this->pdo_query_one($sql_1,$username,$brand,$stt_['id_admin']);
		$sql_check_bank = 'SELECT * FROM `banks` WHERE `bank_name` = ?';
		$result_checkbank = $this->pdo_query_one($sql_check_bank,$brand);
		if (!$stt_) {
			$sms = 8998; // mã lỗi không tìm thấy tài khoản được phép thanh 
		}else if($result_checkbank){
			$sms = 7886; // mã lỗi đã tồn tại ngân hàng trên

		}else if($this->checkCuPhap($cuphap)){
		   	$sms = -47886; // mã lỗi đã tồn tại cú pháp giao dịch
		}else{
			$getToday = date('d-m-Y', time());
			$str_today = strtotime($getToday);
			$str_expires = strtotime($stt_['expires_time']);
			$test_day = true;
			if ($str_expires < $str_today) {
				$test_day = false;
			}
			if ($stt_['expires_time'] == 99 || $test_day == true) {
				$tinhtoan = $this->tinhToanBankDaSuDung($id);
				if ($tinhtoan == 0) {
				// code...
				$sms = 7655; // còn tài khoản đâu =))
			}else{
				if (!$result_1) {
					$sql_2 = 'INSERT INTO `banks`(`stk`,`chuthe`,`id_admin`,`bank_name`,`username`,`password`,`device`,`device_id`,`cuphap`) VALUES(?,?,?,?,?,?,?,?,?)';
					$result_2 = $this->pdo_execute($sql_2,$sotk,$chuthe,$id,$brand,$username,$password,$this->configTbBank['DEVICE_NAME'],$this->generateImei(),$cuphap);
					if ($result_2 == '') {
						$sms = 'done';
					}else{
						$sms = 1;
					}
				}else{
					$sms = -91;
				}

			}
		}else{
			$sms = 5644; // hết hạn sử dụng nạp thêm tiền đê
		}

	}
	return $sms;
}
function checkCuPhap($cuphap){
    $sql='SELECT * FROM `banks` WHERE `cuphap` = ?';
    return $this->pdo_query_one($sql,$cuphap);
}
	// get infoUserBrand
function infoUserByBrand($id,$username,$brand){
	$sql='SELECT * FROM `banks` WHERE `username` = ? AND `bank_name` = ? AND `id_admin` = ?';
	return $this->pdo_query_one($sql,$username,$brand,$id);
}
	// 
function curlTpBank($command,$data,$cookie=''){
	$curl = curl_init();
	$authorization = ($cookie != '') ? $cookie : '';
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://ebank.tpb.vn/gateway/api/'.$command,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => json_encode($data),
		CURLOPT_HTTPHEADER => array(
			'Host: ebank.tpb.vn',
			'PLATFORM_NAME: '.$this->configTbBank['PLATFORM_NAME'],
			'Accept: */*',
			'APP_VERSION: '.$this->configTbBank['APP_VERSION'],
			'SOURCE_APP: HYDRO',
			'Accept-Language: vi-VN;q=1.0',
			'PLATFORM_VERSION: '.$this->configTbBank['PLATFORM_VERSION'],
			'Content-Type: application/json',
			'DEVICE_NAME: '.$this->configTbBank['DEVICE_NAME'],
			'Authorization: '.$authorization,
		 'User-Agent: Hydrobank/10.10.97 (com.fpt.tpb.emobile; build:4; iOS 15.6.1) Alamofire/10.10.97',
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return  json_decode($response);

}
	// bypass captcha
	// 
function curlTpBank_GET($command,$cookie=''){
	$curl = curl_init();
	$authorization = ($cookie != '') ? $cookie : '';
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://ebank.tpb.vn/gateway/api/'.$command,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Host: ebank.tpb.vn',
			'PLATFORM_NAME: '.$this->configTbBank['PLATFORM_NAME'],
			'Accept: */*',
			'APP_VERSION: '.$this->configTbBank['APP_VERSION'],
			'SOURCE_APP: HYDRO',
			'Accept-Language: vi-VN;q=1.0',
			'PLATFORM_VERSION: '.$this->configTbBank['PLATFORM_VERSION'],
			'Content-Type: application/json',
			'Authorization: '.$authorization
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return  json_decode($response);

}

	// bypass captcha
}

?>