<?php
session_start();
$host = 'localhost';
$dbuser = 'root';
$dbpw = '';
$dbname = 'project';
$_SESSION['link'] = mysqli_connect($host, $dbuser, $dbpw, $dbname);

if ($_SESSION['link']) {
  $usrid=$_POST['Userid'];
  $pwsd=$_POST['password'];
  $sql="SELECT* FROM `User` WHERE userid= '$usrid'AND password='$pwsd'";
  $result=mysqli_query($_SESSION['link'],$sql);
  $count = mysqli_num_rows($result);
  if ($count>0) {
    $_SESSION['login_id']=$usrid;
    while ($row=mysqli_fetch_assoc($result)) {
      $_SESSION['login_id']=$row['userid'];
      $_SESSION['login_name']=$row['username'];
    }

    header("location:http://localhost:8080/project/index.php");
  }else{
    echo "<scipt>alert(帳號或密碼有誤);</script>";
  }
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
    <h1>登入帳號</h1>
    <div class="main-agileinfo">
      <div class="agileits-top">
        <form action="login.php" method="post">
          <input class="text" type="text" name="Userid" placeholder="學號" required="">
          <br>
          
          <input class="text" type="password" name="password" placeholder="密碼" required="">
           <br>
          <input type="submit" name="submit" value="登入">
        </form>
        
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