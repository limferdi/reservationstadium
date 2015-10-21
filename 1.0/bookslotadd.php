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
		
	$sql_check = "SELECT * FROM book where book_date = '". $bookdate."' and book_time = '". $booktime."'";
	$result_check = $conn->query($sql_check);
		
	if (@$result_check->num_rows > 0) {
		$response = "already book";
	}			
	else{
	
		$sql_insertbook = "INSERT into book (book_date, book_time, book_userid, book_createddate) VALUES ("."'".$bookdate."','".$booktime."','".$user_id."','".$now."')";
				
		if ($conn->query($sql_insertbook)){	
			$response = "book success";
		}	
		else{
			$response = "book failed";
		}
	}
	
	echo $response;
	
	$conn->close();
?>
