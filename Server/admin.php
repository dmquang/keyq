<?php 
date_default_timezone_set("Asia/Ho_Chi_Minh"); //timezone viet nam
$password = "vqhteam"; // đặt tuỳ chỉnh
$conn = mysqli_connect("localhost","vqhteamc_keyphp","keyphp@@@@!!!!11","vqhteamc_keyphp") or die(json_encode(array("status"=>false,"message"=>"Máy chủ gặp lỗi, liên hệ admin"))); 
function islogin($password){
	if (isset($_COOKIE['user']) && $_COOKIE['user'] == $password) return true;
	else return false;
}
if (isset($_POST['submit'])){
	if ($_POST["p"] == $password){
		setcookie("user",$_POST["p"],time()+(86400*365),"/");
		die(header("Location: /admin.php"));
	}
	die(header("Location: /admin.php"));
}
if (isset($_POST["submit1"])){
	$tg = $_POST['tg'];
	$key = $_POST['key'];
	$in = $_POST['in'];
	if ($tg == 1)$b = time()+$in;
	elseif($tg == 2)$b = time()+(60*$in);
	else $b = time()+(86400*$in);
	if (mysqli_query($conn,"INSERT INTO keyss(key1, time_end ) VALUES ( '$key', '$b')")){
		echo '<script>alert("Thêm key thành công")</script>';
	} else {
			echo '<script>alert("Thêm key thất bại: '.mysqli_error($conn).'")</script>';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Create Key</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body style="margin: 20px;">
<?php 
if (islogin($password)){
?>
<form method="post">
<select name="tg" class="form-select">
  <option disabled selected>Chọn Thời Gian</option>
  <option value="1">Theo Giây</option>
  <option value="2">Theo Phút</option>
  <option value="3">Theo Ngày</option>
</select>
<br>
<input type="number" name="in" min="0" placeholder="Nhập thời gian" class="form-control" required>
<br>
<input type="text" name="key" placeholder="Nhập key..." class="form-control" required>
<br>
<input type="submit" name="submit1" class="btn btn-success" value="Thêm Key">
</form>
<?php
} else {
?>
<form method="post">
<input type="text" name="p" placeholder="Nhập mật khẩu admin...." class="form-control" required>
<br>
<input type="submit" name="submit" class="btn btn-success" value="Đăng nhập">
</form>
<?php
}?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>