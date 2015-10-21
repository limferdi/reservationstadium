<?php 
	date_default_timezone_set("Asia/Jakarta");
	include("config.php");
	
	$now = date("Y-m-d H:i:s");
	$user_id = $_REQUEST["userid"];
	
	$weekpos = $_REQUEST["weekpos"];
	$dateid = $_REQUEST["dateid"];
	$timeid = $_REQUEST["timeid"];
	
	$nowdate = date("m-d-Y");
	$nowdate_temp = str_replace('-', '/', $nowdate);
	$bookdate = date('Y-m-d',strtotime($nowdate_temp . "+". (($weekpos*7)+ $dateid) ." days"));
	
	$initial_time=6;
	$booktime = $initial_time + $timeid;
		
	$sql_check = "SELECT * FROM book where book_date = '". $bookdate."' and book_time = '". $booktime."' and book_userid = '". $user_id."'";
	$result_check = $conn->query($sql_check);
		
	if (@$result_check->num_rows <= 0) {
		$response = "book not found";
	}			
	else{
	
		$sql_deletebook = "Delete from book where book_date='".$bookdate."' and book_time='".$booktime."' and book_userid='".$user_id."'";
				
		if ($conn->query($sql_deletebook)){	
			$response = "book cancel";
		}	
		else{
			$response = "cancel failed";
		}
	}
	
	echo $response;
	
	$conn->close();
?>
