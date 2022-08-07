<?php 
date_default_timezone_set("Asia/Ho_Chi_Minh"); //timezone viet nam
error_reporting(E_ALL);
echo "Vui lòng nhập key: ";
$key = trim(fgets(STDIN));
if (empty($key))die("Vui lòng nhập key..\n");
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://keyphp.vqhteam.com/check.php',
    CURLOPT_POST => true,
    CURLOPT_SSL_VERIFYPEER => false, 
    CURLOPT_POSTFIELDS => 'key='.$key,
));
$resp = curl_exec($curl);
if (curl_errno($curl))die(curl_error($curl));
curl_close($curl);
$json = json_decode($resp,1);
if ($json["status"] != true)die($json["message"]."\n");
echo "Đăng nhập thành công, chúc bạn sử dụng tool vui vẻ \n";
echo "Tool dùng đến: ".gmdate("d-m-Y H:i:s", $json["end"])."\n\n";
