<?php
  error_reporting(E_ERROR | E_PARSE);
  session_start(); 
  $host = 'localhost';
  $dbuser = 'root';
  $dbpw = '';
  $dbname = 'project';
  $_SESSION['link'] = mysqli_connect($host, $dbuser, $dbpw, $dbname);
  // echo "$_SESSION['day']";

  if (isset($_POST['submit'])) {
    $equip=$_POST['equip'];
    $rtn_date=date ("Y-m-d", strtotime(str_replace('/', '-',$_POST['return_date'] )) );
    $purpose=htmlspecialchars($_POST['purpose']);
    $sql="INSERT INTO `Apply`(`userid`, `classid`, `office`, `purpose`, `return_date`, `borrower`, `date`, `course_time`, `day`) VALUES ('$_SESSION[login_id]','$_SESSION[classroom]','Of01','sd','$rtn_date','$_SESSION[login_name]','$_SESSION[time]','$_SESSION[course_time]','$_SESSION[day]')";
    mysqli_query($_SESSION['link'],$sql);
    if (count($equip)==0) {
      // echo "count($equip)";
      header("Location:./success.php");
    }else{ 
      for($i=0;$i<count($equip);$i++){
        $singl_equip=$equip[$i];
        // echo "$singl_equip";
        $sql2="INSERT INTO `Classroom_with_Equip`(`userid`, `classid`, `date`, `day`, `course_time`, `equipid`) VALUES ('$_SESSION[login_id]','$_SESSION[classroom]','$_SESSION[time]','$_SESSION[day]','$_SESSION[course_time]','$singl_equip')";
        $sql_query_avail="SELECT`available`FROM `Equipment` WHERE `equip_name`=$singl_equip AND `available`=1";
        $res_query_avail=mysqli_query($_SESSION['link'],$sql_query_avail);
        $num=count($res_query_avail);
        echo "$num";
        echo "$res_query_avail";
        if ($res_query_avail=='') {
          echo "<script> alert('".$singl_equip."is not available');</script>";
        }else {
          $sql_equip_avil="UPDATE `Equipment` SET `available`=0 WHERE `equip_name`=$singl_equip AND`available`=1";
          echo "hello";
          mysqli_query($_SESSION['link'],$sql2);
          mysqli_query($_SESSION['link'],$sql_equip_avil);
          header("Location:./success.php");
        }
        
      }
    } 
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>登記教室</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css" rel="stylesheet" id="bootstrap-css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
  <script >
      $(function () {
          $('#datepicker').datepicker({
              format: "dd/mm/yyyy",
              autoclose: true,
              todayHighlight: true,
            showOtherMonths: true,
            selectOtherMonths: true,
            autoclose: true,
            changeMonth: true,
            changeYear: true,
            orientation: "button"
          });
      });
  </script>
<!-- //web font -->
</head>
<body>
  <!-- main -->
  <div class="main-w3layouts wrapper">
    <h1>教室租借申請</h1>
    <div class="main-agileinfo">
      <div class="agileits-top" >
        <form action="apply.php" method="post">
        
          </div> 
           <div class='input-group date' id='datepicker' style="margin-left: 50px;">
              <label>歸還日期</label>
              <input type='text' class="form-control" id=''/ name="return_date" placeholder="日期">
              <span >
                  <!-- <span class="glyphicon glyphicon-calendar"></span> -->
              </span>
            
           </div>
           <div style="margin-left: 50px;">
             <label>用途</label>
           </div>
           <div style="margin-top: 20px;margin-left: 50px;">
              <!-- <label>用途</label> -->
              <textarea  rows="4" cols="50" name="purpose"  ></textarea>
           </div>
           <div style="margin-top: 30px;margin-left: 50px;">
            <label>器材</label>
            <br>
             <input type="checkbox" name="equip[]" value="projector"> 投影機<br>
              <input type="checkbox" name="equip[]" value="extensor">延長線<br>
              <input type="checkbox" name="equip[]" value="marker"> 馬克筆<br>
              <input type="checkbox" name="equip[]" value="microphone"> 麥克風<br>
              <input type="checkbox" name="equip[]" value="transformer"> 轉接頭<br><br>

           </div>
          <input type="submit" name="submit" value="登記">
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