<?php
header('Content-Type: application/json; charset=UTF-8'); 
$host = 'localhost';
$dbuser = 'root';
$dbpw = '';
$dbname = 'project';
$_SESSION['link'] = mysqli_connect($host, $dbuser, $dbpw, $dbname);

$timestring=$_POST['qt'];
list($from,$end)=explode("~", $timestring);
$from=date("Y-m-d",strtotime($from));
$end=date("Y-m-d",strtotime($end));
$classroom=$_POST['qc'];

$sql="SELECT*FROM `Apply` WHERE `date` BETWEEN '$from' AND '$end'AND `classid`='$classroom' ";
$result=mysqli_query($_SESSION['link'],$sql);

$schedule_json=array('Monday'=>array(),'Tuesday'=>array(),'Wednesday'=>array(),'Thursday'=>array(),'Friday'=>array());

while ($row=mysqli_fetch_assoc($result)) {
	// echo $row['course_time'];
	// echo "\n";
	if($row['day']=='Monday'){
		if($row['course_time']=='A'){
			$schedule_json['Monday']+=array('A'=> $row['borrower']);
		}elseif ($row['course_time']=='B') {
			$schedule_json['Monday']+=array('B'=> $row['borrower']);
		}elseif ($row['course_time']=='C') {
			$schedule_json['Monday']+=array('C'=> $row['borrower']);
		}elseif ($row['course_time']=='D') {
			$schedule_json['Monday']+=array('D'=> $row['borrower']);
		}
	}elseif ($row['day']=='Tuesday') {
		if($row['course_time']=='A'){
			$schedule_json['Tuesday']+=array('A'=> $row['borrower']);
		}elseif ($row['course_time']=='B') {
			$schedule_json['Tuesday']+=array('B'=> $row['borrower']);
		}elseif ($row['course_time']=='C') {
			$schedule_json['Tuesday']+=array('C'=> $row['borrower']);
		}elseif ($row['course_time']=='D') {
			$schedule_json['Tuesday']+=array('D'=> $row['borrower']);
		}
	}elseif ($row['day']=='Wednesday') {
		if($row['course_time']=='A'){
			$schedule_json['Wednesday']+=array('A'=> $row['borrower']);
		}elseif ($row['course_time']=='B') {
			$schedule_json['Wednesday']+=array('B'=> $row['borrower']);
		}elseif ($row['course_time']=='C') {
			$schedule_json['Wednesday']+=array('C'=> $row['borrower']);
		}elseif ($row['course_time']=='D') {
			$schedule_json['Wednesday']+=array('D'=> $row['borrower']);
		}
		 
	}elseif ($row['day']=='Thursday') {
		if($row['course_time']=='A'){
			$schedule_json['Thursday']+=array('A'=> $row['borrower']);
		}elseif ($row['course_time']=='B') {
			$schedule_json['Thursday']+=array('B'=> $row['borrower']);
		}elseif ($row['course_time']=='C') {
			$schedule_json['Thursday']+=array('C'=> $row['borrower']);
		}elseif ($row['course_time']=='D') {
			$schedule_json['Thursday']+=array('D'=> $row['borrower']);
		}
		 
	}elseif ($row['day']=='Friday') {
		if($row['course_time']=='A'){
			$schedule_json['Friday']+=array('A'=> $row['borrower']);
		}elseif ($row['course_time']=='B') {
			$schedule_json['Friday']+=array('B'=> $row['borrower']);
		}elseif ($row['course_time']=='C') {
			$schedule_json['Friday']+=array('C'=> $row['borrower']);
		}elseif ($row['course_time']=='D') {
			$schedule_json['Friday']+=array('D'=> $row['borrower']);
		}
		 
	}
}

echo json_encode($schedule_json); 
// var_dump($result);
?>