<?php
function mbRefNo(){
  $rand = mt_rand(10,99);
  $time = date('YmdHis',time());
  return $time.$rand;
}
function doLogin($refNo,$captcha){


$curl = curl_init();
$data = array(
  'userId' => 'quyendz',
  'password'=> '29b8fd409e7889873d46b70ccdaf93e4',
  'captcha' => $captcha,
  'sessionId' => null,
  'refNo' => $refNo,
  'deviceIdCommon' => '2bgww5h7-mbib-0000-0000-2022092217425682'
   );
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://online.mbbank.com.vn/api/retail_web/internetbanking/doLogin',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($data),
  CURLOPT_HTTPHEADER => array(
    'Host: online.mbbank.com.vn',
    'sec-ch-ua: "Not?A_Brand";v="8", "Chromium";v="108", "Google Chrome";v="108"',
    'sec-ch-ua-mobile: ?0',
    'Authorization: Basic RU1CUkVUQUlMV0VCOlNEMjM0ZGZnMzQlI0BGR0AzNHNmc2RmNDU4NDNm',
    'elastic-apm-traceparent: 00-9b0f28f0fc93cfe270708d14fc01328d-a57a9deacbbb7d54-01',
    'Content-Type: application/json; charset=UTF-8',
    'Accept: application/json, text/plain, */*',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36',
    'sec-ch-ua-platform: "Windows"',
    'Origin: https://online.mbbank.com.vn',
    'Sec-Fetch-Site: same-origin',
    'Sec-Fetch-Mode: cors',
    'Sec-Fetch-Dest: empty',
    'Referer: https://online.mbbank.com.vn/pl/login?returnUrl=%2F',
    'Accept-Language: en-US,en;q=0.9,vi;q=0.8',
    'Cookie: _ga=GA1.3.1036958448.1663843376; _gid=GA1.3.1820199609.1673540863; BIGipServerk8s_online_banking_pool_9712=1679556874.61477.0000; MBAnalyticsaaaaaaaaaaaaaaaa_session_=GDOPEPFJIMHNGFPCMGKBDNELMCKHLAFDIMHAKGHKAHNJCOCBHNBFOPBAADOONLJNPAADMNNNIBJHLIIINHEAGEJLDEJFCAFGEEHFOJNKDPNADJMEGMPJNBOFJEOOHFDP; BIGipServerk8s_KrakenD_Api_gateway_pool_10781=3323724042.7466.0000; JSESSIONID=DBE025420E88A3729223C53B52299782; BIGipServerk8s_KrakenD_Api_gateway_pool_10781=1679556874.7466.0000; JSESSIONID=074E8974AAC63191E0ED013655384DC0'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return json_decode($response);

}
function getCaptchaMbBank($refNo){

  $curl = curl_init();
  $data  = array(
    'refNo' => $refNo, 
    'deviceIdCommon' => '2bgww5h7-mbib-0000-0000-2022092217425682',
    'sessionId' => ''
  );
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://online.mbbank.com.vn/api/retail-web-internetbankingms/getCaptchaImage',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => array(
      'Host: online.mbbank.com.vn',
      'sec-ch-ua: "Not?A_Brand";v="8", "Chromium";v="108", "Google Chrome";v="108"',
      'sec-ch-ua-mobile: ?0',
      'Authorization: Basic RU1CUkVUQUlMV0VCOlNEMjM0ZGZnMzQlI0BGR0AzNHNmc2RmNDU4NDNm',
      'Content-Type: application/json; charset=UTF-8',
      'Accept: application/json, text/plain, */*',
      'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36',
      'sec-ch-ua-platform: "Windows"',
      'Origin: https://online.mbbank.com.vn',
      'Sec-Fetch-Site: same-origin',
      'Sec-Fetch-Mode: cors',
      'Sec-Fetch-Dest: empty',
      'Referer: https://online.mbbank.com.vn/pl/login?returnUrl=%2F',
      'Accept-Language: en-US,en;q=0.9,vi;q=0.8',
      'Cookie: _ga=GA1.3.1036958448.1663843376; _gid=GA1.3.1820199609.1673540863; BIGipServerk8s_online_banking_pool_9712=1679556874.61477.0000; MBAnalyticsaaaaaaaaaaaaaaaa_session_=GDOPEPFJIMHNGFPCMGKBDNELMCKHLAFDIMHAKGHKAHNJCOCBHNBFOPBAADOONLJNPAADMNNNIBJHLIIINHEAGEJLDEJFCAFGEEHFOJNKDPNADJMEGMPJNBOFJEOOHFDP; BIGipServerk8s_KrakenD_Api_gateway_pool_10781=1679556874.7466.0000; JSESSIONID=074E8974AAC63191E0ED013655384DC0'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  return json_decode($response);

}
if (isset($_POST) && $_POST) {
   $captcha = $_POST['captcha'];
   $refNoer = 'f32af360d2699394b0a1d6b14543d902-'.mbRefNo();
$test = doLogin($refNoer,$captcha);
print_r($test);
}else{


  $result = getCaptchaMbBank(mbRefNo());

  ?>
  <form action="/test.php" method="POST">
    <img src="data:image/png;base64,<?= $result->imageString ?>" alt="">
    <input name="captcha" type="text" placeholder="Nhập Captcha">
    <button>Gửi đi </button>
  </form>
  <?php
}
?>