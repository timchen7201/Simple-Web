<?php
session_start();
$host = 'localhost';
$dbuser = 'root';
$dbpw = '';
$dbname = 'project';
$_SESSION['link'] = mysqli_connect($host, $dbuser, $dbpw, $dbname);

if ($_SESSION['link']){
  mysqli_query($_SESSION['link'], "SET NAMES utf8");
  if (isset($_POST['submit'])) {
   	$usrid=$_POST['Userid'];
   	$usrname=$_POST['Username'];
   	$email=$_POST['email'];
   	$labid=$_POST['labid'];
   	$phone=$_POST['phone'];
   	$pwsd=$_POST['password'];
   	// $sql="SELECT* FROM `User` WHERE userid= '$usrid'";
   	$sql="INSERT INTO `User`(`userid`, `username`, `email`, `labid`, `phone`,`password`) VALUES ('$usrid','$usrname','$email','$labid','$phone','$pwsd')";
   	$result=mysqli_query($_SESSION['link'],$sql);
   	// var_dump($result);
   	
   } 
}
else{
  echo '無法連線mysql資料庫 :<br/>' . mysqli_connect_error();
}



?>

<!DOCTYPE html>
<html>
<head>
<title>註冊</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css">
<!-- //web font -->
</head>
<body>
  <!-- main -->
  <div class="main-w3layouts wrapper">
    <div class="main-agileinfo">
      <div class="agileits-top">
		<?php 
			if ($result) {
				echo "<h1>註冊成功</h1>";
				echo "<a href='../index.php' style='margin-right:20px;'>回到主頁</a>";
			}else{
				echo "<h1>註冊失敗</h1>";
				
			}
		 ?>
        
      </div>
    </div>
    
    <ul class="colorlib-bubbles">
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
    </ul>
  </div>
  <!-- //main -->
</body>
</html>