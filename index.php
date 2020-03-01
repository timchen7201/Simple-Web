<?php
session_start();
require_once("./php/connect.php");
$user=$_SESSION['login_name'];
$userid=$_SESSION['login_id'];
// echo "1";
if (isset($_POST['search'])) {
	$_SESSION['time']=date ("Y-m-d", strtotime(str_replace('/', '-',$_POST['time'] )) );

	$_SESSION['day']=date('l', strtotime($_SESSION['time']));
	// echo $_SESSION['day'];
	$_SESSION['course_time']=$_POST['course_time'];
	$_SESSION['classroom']=$_POST['classroom'];
	$sql="SELECT*FROM `Apply` WHERE `date`='$_SESSION[time]' AND `classid`='$_SESSION[classroom]' AND `course_time`='$_SESSION[course_time]'";

	$result=mysqli_query($_SESSION['link'],$sql);
	// echo $result;
	echo $result->num_rows;
	if ($result->num_rows!==0) {
		echo "<script>此時段的教室無法借用，請查明後再申請。</script>";

	}else{
		echo $_SESSION['time'];
		header("Location:./form/apply.php");
	}
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>教室與器材借用系統</title>
	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/style.css"/>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style2.css"> <!-- Resource style -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$('.single-event').hide();
			$('#query_time').on("change",function(){
				var query_time=$(this).val();
				$('#query_classroom').on("change",function(){
					var query_class=$(this).val();
					 
					if(query_time!=''&&query_class!=''){
						$.ajax({
							type: "POST",
							url: "./php/avali_result.php",
							data : {
		    					'qt':query_time,
		    					'qc':query_class
		    				},
		    				dataType:'html',
		    				success:function(data){

		    					var obj=JSON.parse(data);
		    					console.log(obj);
		    					var keys=Object.keys(obj);
		    					// console.log(keys);
		    					for (var day in obj){
								    if (obj.hasOwnProperty(day)) {
								    	if(obj[day]!=""){
								    		for (var course in obj[day]){
								    			if(obj[day].hasOwnProperty(course)){
								    				console.log("Day:"+day+",course:"+course+",borrower:"+obj[day][course]);
								    				var key_string="#";
								    				var key_string=key_string.concat(day,"_",course);
								    				$(key_string).show();
								    				$(key_string).append("						<a href='#0'><em class='event-name'>"+obj[day][course]+"</em></a>\
");
								    				console.log(key_string);

								    			}
								    		}
								    	}
								        // alert("Key is " + day+ ", value is" + obj[day]);
								    }
								}

		    					var element=document.getElementById('Monday_ul');
		    					// $('#monday_a').addClass("single-event");
		    					
		    					
		    	 
		    				},
		    				error: function(jqXHR) {
	                 			console.log(jqXHR.responseText);

	            			}
						});
					}
				});
			});
		}); 
		
	</script>


</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	
	<!-- Header section -->
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 header-top-left">
						<div class="top-info">
							<i class="fa fa-phone"></i>
							(+88) 666 121 4321
						</div>
						 
					</div>
					<div class="col-lg-6 text-lg-right header-top-right">
						 
						<div class="user-panel">
							<a href="./form/register.php"><i class="fa fa-user-circle-o"></i> 註冊</a>
							<a href="./form/login.php"><i class="fa fa-sign-in"></i> 登入</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		 
	</header>
	<!-- Header section end -->


	<!-- Hero section -->
	<section class="hero-section set-bg" data-setbg="img1/bg.jpg">
		<div class="container hero-text text-white">
			 
			<?php
				if ($user!="") {
					echo "<a class='site-btn' href=./personal_page/index.php>$user 你好</a>";
				}else{
					echo "<a href='#' class='site-btn'>VIEW DETAIL</a>";
				}
			?>
			
		</div>
	</section>
	<!-- Hero section end -->


	<!-- Filter form section -->
	<div class="filter-search">
		<div class="container">
			<form name="first_form" class="filter-form" action="./index.php" method="post"  onsubmit="return validateForm()">
				<!-- <input type="text" placeholder="Enter a street name, address number or keyword">
				<select> -->
					 <div class='input-group date' id='datepicker' style="width: 150px;float: left;">
		                    <input type='text' class="form-control" name="time" id=''/ placeholder="日期">
		                    <span class="input-group-addon">
		                        <span class="glyphicon glyphicon-calendar"></span>
		                    </span>
		                 
		                </div>
		                <div style="margin-top: 0 px;padding-right: 10 px; "> 
		                	 
				          	<select name="course_time">
				           	<option value="A">第2,3,4節</option>
				           	<option value="B">第5,6,7節</option>
				           	<option value="C">第8,9節</option>
				           	<option value="D">第C,D,E節</option>
				           </select>
				           <select name="classroom">
				           	<option value="" disabled selected>教室</option>
				           	<option value="3021">3021</option>
				           	<option value="4069">4069</option>
				           	<option value="3051">3051</option>
				           </select> 
				          <!--  <textarea placeholder="用途" style="margin-top: 30px;"></textarea>  -->
				           <button class="site-btn fs-submit" name="search">我要預訂</button>
 						 
			</form>
		</div>
	</div>
	<!-- Filter form section end -->



	<!-- Properties section -->
	<section class="properties-section spad">
		<div class="container">
			<div class="section-title text-center">
				<span style="font-size: 40px;">教室預借狀況</span>
			</div>
			<div>
				<form  method="post">
					<select id="query_time">
						<option value="" disabled selected>時間</option>
						<option value="2018/09/10~2018/09/16">第一週（2018/09/10~2018/09/16）</option>
						<option value="2018/09/17~2018/09/23">第二週（2018/09/17~2018/09/23）</option>
						<option value="2018/09/24~2018/09/30">第三週（2018/09/24~2018/09/30）</option>
						<option value="2018/10/01~2018/10/07">第四週（2018/10/01~2018/10/07）</option>
						<option value="2018/10/08~2018/10/14">第五週（2018/10/08~2018/10/14）</option>
						<option value="2018/10/15~2018/10/21">第六週（2018/10/15~2018/10/21）</option>
						<option value="2018/10/22~2018/10/28">第七週（2018/10/22~2018/10/28）</option>
						<option value="2018/10/29~2018/11/04">第八週（2018/10/29~2018/11/04）</option>
						<option value="2018/11/05~2018/11/11">第九週（2018/11/05~2018/11/11）</option>
						<option value="2018/11/12~2018/11/18">第十週（2018/11/12~2018/11/18）</option>
						<option value="2018/11/19~2018/11/25">第十一週（2018/11/19~2018/11/25）</option>
						<option value="2018/11/26~2018/12/02">第十二週（2018/11/26~2018/12/02）</option>
						<option value="2018/12/03~2018/12/09">第十三週（2018/12/03~2018/12/09）</option>
						<option value="2018/12/10~2018/12/16">第十四週（2018/12/10~2018/12/16）</option>
						<option value="2018/12/17~2018/12/23">第十五週（2018/12/17~2018/12/23）</option>
						<option value="2018/12/24~2018/12/30">第十六週（2018/12/24~2018/12/30）</option>
						<option value="2018/12/31~2019/01/06">第十七週（2018/12/31~2019/01/06）</option>
						<option value="2019/01/07~2019/01/13">第十八週（2019/01/07~2019/01/13）</option>
					</select>
					<div style="display: inline-block; margin-left: 20px;">
						<!-- <input id="test" type="text"></input> -->
						<select id="query_classroom">
							<option value="" disabled selected>教室</option>
							<option>3051</option>
							<option>4069</option>

						</select>
					</div>
				</form>
			</div>
			<div class="cd-schedule loading">
				<div class="timeline">
					<ul>
						<li><span>09:00</span></li>
						<li><span>09:30</span></li>
						<li><span>10:00</span></li>
						<li><span>10:30</span></li>
						<li><span>11:00</span></li>
						<li><span>11:30</span></li>
						<li><span>12:00</span></li>
						<li><span>12:30</span></li>
						<li><span>13:00</span></li>
						<li><span>13:30</span></li>
						<li><span>14:00</span></li>
						<li><span>14:30</span></li>
						<li><span>15:00</span></li>
						<li><span>15:30</span></li>
						<li><span>16:00</span></li>
						<li><span>16:30</span></li>
						<li><span>17:00</span></li>
						<li><span>17:30</span></li>
						<li><span>18:00</span></li>
					</ul>
				</div> <!-- .timeline -->
				<div class="events">
		<ul>
			<li class="events-group">
				<div class="top-info" style="color: #000"><span>Monday</span></div>

				<ul >
					<li class="" data-start="09:00" data-end="12:00" data-content="event-abs-circuit" data-event="event-1" id="Monday_A">
						 
					</li>

					<li class="single-event" data-start="13:00" data-end="16:00" data-content="event-rowing-workout" data-event="event-2" style="display: none;" id="Monday_B">
						 
					</li>

					<li class="single-event" data-start="16:00" data-end="18:00"  data-content="event-yoga-1" data-event="event-3" id="Monday_C">
						 
					</li>

					 
				</ul>
			</li>

			<li class="events-group">
				<div class="top-info" style="color: #000"><span>Tuesday</span></div>

				<ul>
					<li class="single-event" data-start="09:00" data-end="12:00"  data-content="event-rowing-workout" data-event="event-2" id="Tuesday_A">
						 
					</li>

					<li class="single-event" data-start="13:00" data-end="16:00"  data-content="event-restorative-yoga" data-event="event-4" id="Tuesday_B">
						 
					</li>

					<li class="single-event" data-start="16:00" data-end="18:00" data-content="event-abs-circuit" data-event="event-1" id="Tuesday_C">
						 
					</li>
 
				</ul>
			</li>

			<li class="events-group">
				<div class="top-info" style="color: #000"><span>Wednesday</span></div>

				<ul>
					<li class="single-event" data-start="09:00" data-end="12:00" data-content="event-restorative-yoga" data-event="event-4">
						 
					</li>

					<li class="single-event" data-start="13:00" data-end="16:00" data-content="event-yoga-1" data-event="event-3">
						 
					</li>

					<li class="single-event" data-start="16:00" data-end="18:00"  data-content="event-rowing-workout" data-event="event-2">
						 
					</li>
 
				</ul>
			</li>

			<li class="events-group">
				<div class="top-info" style="color: #000"><span>Thursday</span></div>

				<ul>
					<li class="single-event" data-start="09:00" data-end="12:00" data-content="event-abs-circuit" data-event="event-1" id="Thursday_A">
					</li>

					<li class="single-event" data-start="13:00" data-end="16:00" data-content="event-restorative-yoga" data-event="event-4" id="Thursday_B">
						 
					</li>

					<li class="single-event" data-start="16:00" data-end="18:00" data-content="event-abs-circuit" data-event="event-1">
						 
					</li>

				 
				</ul>
			</li>

			<li class="events-group">
				<div class="top-info" style="color: #000"><span>Friday</span></div>

				<ul>
					<li class="single-event" data-start="09:00" data-end="12:00"  data-content="event-rowing-workout" data-event="event-2" id="Friday_A">
						 
					</li>

					<li class="single-event" data-start="13:00" data-end="16:00" data-content="event-abs-circuit" data-event="event-1" id="Friday_B">
						 
					</li>

					<li class="single-event" data-start="16:00" data-end="18:00"  data-content="event-yoga-1" data-event="event-3" id="Friday_C">
						 
					</li>
				</ul>
			</li>
		</ul>
	</div>

	<div class="event-modal">
		<header class="header">
			<div class="content">
				<span class="event-date"></span>
				<h3 class="event-name"></h3>
			</div>

			<div class="header-bg"></div>
		</header>

		<div class="body">
			<div class="event-info"></div>
			<div class="body-bg"></div>
		</div>

		<a href="#0" class="close">Close</a>
	</div>

	<div class="cover-layer"></div>
			</div>
			 
		</div>
	</section>
	<!-- Properties section end -->

 


 
                                        
	<!--====== Javascripts & Jquery ======-->
	<!-- <script src="js/jquery-3.2.1.min.js"></script> -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script src="js/magnific-popup.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/main2.js"></script>
	<script src="js/modernizr.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
	<script src="js/modernizr.js"></script>
 
<script src="js/main.js"></script> <!-- Resource jQuery -->

	<script >
		function validateForm(){
			var calander_value=document.forms["first_form"]["time"].value;
			// alert(calander_value);
			if (calander_value=='') {
				alert("必須填寫日期");
				return false;
			}
		}
		if( !window.jQuery ) document.write('<script src="js/jquery-3.0.0.min.js"><\/script>');
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
	
</body>
</html>












