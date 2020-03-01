<?php
  session_start();
  require_once("../php/connect.php");
  $name=$_SESSION['login_name']; 
  $sql="SELECT *FROM `Apply` WHERE `borrower`= '$name'";
  $result=mysqli_query($_SESSION['link'],$sql);
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Personal page</title>
  <script type="text/javascript"></script>
  <style type="text/css">
    
h1{
  font-size: 30px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 300;
  text-align: center;
  margin-bottom: 15px;
}
table{
  width:100%;
  table-layout: fixed;
}
.tbl-header{
  background-color: rgba(255,255,255,0.3);
 }
.tbl-content{
  height:300px;
  overflow-x:auto;
  margin-top: 0px;
  border: 1px solid rgba(255,255,255,0.3);
}
th{
  padding: 20px 15px;
  text-align: left;
  font-weight: 500;
  font-size: 12px;
  color: #fff;
  text-transform: uppercase;
}
td{
  padding: 15px;
  text-align: left;
  vertical-align:middle;
  font-weight: 300;
  font-size: 12px;
  color: #fff;
  border-bottom: solid 1px rgba(255,255,255,0.1);
}


/* demo styles */

@import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
body{
  background: -webkit-linear-gradient(left, #25c481, #25b7c4);
  background: linear-gradient(to right, #25c481, #25b7c4);
  font-family: 'Roboto', sans-serif;
}
section{
  margin: 50px;
}


/* follow me template */
.made-with-love {
  margin-top: 40px;
  padding: 10px;
  clear: left;
  text-align: center;
  font-size: 10px;
  font-family: arial;
  color: #fff;
}
.made-with-love i {
  font-style: normal;
  color: #F50057;
  font-size: 14px;
  position: relative;
  top: 2px;
}
.made-with-love a {
  color: #fff;
  text-decoration: none;
}
.made-with-love a:hover {
  text-decoration: underline;
}


/* for custom scrollbar for webkit browser*/

::-webkit-scrollbar {
    width: 6px;
} 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
} 
::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
}
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>
  <section>
  <!--for demo wrap-->
  <h1>您的租借狀況</h1>
  <div class="tbl-header" style="font-size: 20px;">
    <table cellpadding="0" cellspacing="0" border="0" >
      <thead>
        <tr>
          <th>日期</th>
          <th>時間</th>
          <th>教室</th>
          <th>歸還日期</th>
          <th>設備</th>
          <!-- <th>用途</th> -->
        </tr>
      </thead>
    </table>
  </div>
  <div class="tbl-content">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody style="text-align: center;">
      <?php
        while ($row=mysqli_fetch_assoc($result)) {
          // echo "sds";
          echo "<tr>";
          echo "<td>$row[date]</td>";
          echo "<td>$row[course_time]</td>";
          echo "<td>$row[classid]</td>";
          echo "<td>";
          // echo $_SESSION['login_id'];
          $sql_equip_srch="SELECT `equipid` FROM `Classroom_with_Equip` WHERE `date`='$row[date]'AND `userid`='$_SESSION[login_id]'";
          $result_equip_srch=mysqli_query($_SESSION['link'],$sql_equip_srch);
          while ($row1=mysqli_fetch_assoc($result_equip_srch)) {
                echo $row1['equipid'];
                echo "、";
          }
          echo "</td>";
          echo "</tr>";
        }

      ?>
      
        <!-- <tr>
          <td>AAC</td>
          <td>AUSTRALIAN COMPANY </td>
          <td>$1.38</td>
          <td>+2.01</td>
          <td>-0.36%</td>
        </tr>
        <tr>
          <td>AAD</td>
          <td>AUSENCO</td>
          <td>$2.38</td>
          <td>-0.01</td>
          <td>-1.36%</td>
        </tr> -->
         
      </tbody>
    </table>
  </div>
</section>


<!-- follow me template -->

<script type="text/javascript">
  // '.tbl-content' consumed little space for vertical scrollbar, scrollbar width depend on browser/os/platfrom. Here calculate the scollbar width .
$(window).on("load resize ", function() {
  var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
  $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();
</script>
</body>
</html>