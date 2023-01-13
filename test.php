<?php
  function mbRefNo(){
    $rand = mt_rand(10,99);
    $time = date('YmdHis',time());
    return $time.$rand;
  }
  
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://online.mbbank.com.vn/api/retail-web-transactionservice/transaction/getTransactionAccountHistory',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "accountNo": "1060140019999",
  "fromDate": "01/11/2022",
  "toDate": "13/01/2023",
  "sessionId": "eb89a3f5-1a43-4303-bd19-56abb178cc98",
  "refNo": "QUYENDZ-'.mbRefNo().'",
  "deviceIdCommon": "2bgww5h7-mbib-0000-0000-2022092217425682",
  "type": "ACCOUNT",
  "historyType": "DATE_RANGE"
}',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json, text/plain, */*',
    'Accept-Language: en-US,en;q=0.9,vi;q=0.8',
    'Authorization: Basic RU1CUkVUQUlMV0VCOlNEMjM0ZGZnMzQlI0BGR0AzNHNmc2RmNDU4NDNm',
    'Connection: keep-alive',
    'Content-Type: application/json; charset=UTF-8',
    'Cookie: MBAnalyticsaaaaaaaaaaaaaaaa_session_=JENDDIFACDOHIOCPMAEEBBDKGBCNJOKMCKOIOCCBNELKEBJIHPFDKGINBEBMHDOCPDHDNOPPJHGKMBINKJNAHNDNIDHOFGJKCGGBIJCFNNACOJPOFLAABINDMOAEBOIP; _ga=GA1.3.1036958448.1663843376; BIGipServerk8s_online_banking_pool_9712=3441164554.61477.0000; MBAnalyticsaaaaaaaaaaaaaaaa_session_=DGBNMPOJFLJHEJBHIHKCJJDEOHLJAKOBDKBJLFGNNHHECJEBDJFMALFMPPAPLFCEBLCDKJELNEHKIFIBMABAHDGCDDEPJDILPFONDJMIKHOPPJJPBAADFFHBGKJFCBCC; _gid=GA1.3.1820199609.1673540863; BIGipServerk8s_KrakenD_Api_gateway_pool_10781=1679556874.7466.0000; _gat_gtag_UA_205372863_2=1; JSESSIONID=CFF39891B0D57FAD97C5174D5A280AD4; BIGipServeronline_mbbank_retail_web_pool_8686=2668757258.60961.0000; JSESSIONID=2CACD89AADA307AD49413625EFC39A16',
    'Origin: https://online.mbbank.com.vn',
    'Referer: https://online.mbbank.com.vn/information-account/source-account',
    'Sec-Fetch-Dest: empty',
    'Sec-Fetch-Mode: cors',
    'Sec-Fetch-Site: same-origin',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36',
    'elastic-apm-traceparent: 00-2479edeb3c28197e5576991d03a372c3-73a0db055a0c5b27-01',
    'sec-ch-ua: "Not?A_Brand";v="8", "Chromium";v="108", "Google Chrome";v="108"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
