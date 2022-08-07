<?php 
date_default_timezone_set("Asia/Ho_Chi_Minh"); //timezone viet nam
function ToJson($array){
    return json_encode($array);
}
$conn = mysqli_connect("localhost","vqhteamc_keyphp","keyphp@@@@!!!!11","vqhteamc_keyphp") or die(ToJson(array("status"=>false,"message"=>"Máy chủ gặp lỗi, liên hệ admin"))); 
if (isset($_POST["key"]) && !empty($_POST["key"])){
$key = $_POST["key"];  
// kiểm tra xem key user gửi lên có kí tự đặc biệt ko ``@#....
if (!preg_match('/[\'^£$%&*()}"{@#~?><>,|=_+¬-]/',$key)){
$query = mysqli_query($conn,"SELECT key1, time_end FROM keyss WHERE key1='$key' LIMIT 1"); 
if (mysqli_num_rows($query) < 1) die(ToJson(array("status"=>false,"message"=>"Key bạn nhập không tồn tại trên hệ thống"))); 
$row = mysqli_fetch_array($query);
if ($row["time_end"] <= time())die(ToJson(array("status"=>false,"message"=>"Key hệt hạn rồi, liên hệ admin để gia hạn nhé !!!"))); 
die(ToJson(array("status"=>true,"message"=>"Đăng nhập thành công !!!","end"=>$row["time_end"]))); 
}else die(ToJson(array("status"=>false,"message"=>"Key Tool Bạn Gửi Lên Không Hợp Lệ"))); 
}else die(ToJson(array("status"=>false,"message"=>"Thiếu dữ liệu gửi lên"))); 