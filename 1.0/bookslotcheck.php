<?php 
	date_default_timezone_set("Asia/Jakarta");
	include("config.php");
	
	$now = date("Y-m-d H:i:s");
	
	$weekpos = $_REQUEST["weekpos"];
	
	$nowdate = date("m-d-Y");
	$nowdate_temp = str_replace('-', '/', $nowdate);
	
	$datebegin = date('Y-m-d',strtotime($nowdate_temp . "+". (($weekpos*7)+ 0) ." days"));
	$dateend =  date('Y-m-d',strtotime($nowdate_temp . "+". (($weekpos*7)+ 6) ." days"));
					
	$sql_check = "SELECT * FROM book where book_date >= '". $datebegin."' and book_date < '". $dateend."'";
	$result_check = $conn->query($sql_check);
		
	if (@$result_check->num_rows <= 0) {
		$response = "no book";
	}			
	else{
		$bookslots = array();
		while($allRow = mysqli_fetch_array($result_check)) {
			
			$bookslot = array(
                        'book_userid' => $allRow['book_userid'],
                        'book_date' => $allRow['book_date'],
                        'book_time' => $allRow['book_time']
                    );
					
			$bookslots[] = $bookslot;
		}	
		$response = json_encode($bookslots);	
	}
	
	echo $response;
	
	$conn->close();
?>
