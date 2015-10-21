<?php 
	date_default_timezone_set("Asia/Jakarta");
	include("config.php");
	
	$now = date("Y-m-d H:i:s");
	
	$email = $_REQUEST["email"];
	$password = $_REQUEST["password"];
			
	$sql_check = "SELECT * FROM user where user_email = '". $email."' and user_password = '". $password."'";
	$result_check = $conn->query($sql_check);
		
	if (@$result_check->num_rows <= 0) {
		$response = "Invalid email or password";
	}			
	else{
		$result_sessionnew = $conn->query($sql_sessionnew);
					
		while($row_check = $result_check->fetch_assoc()) {
			$user_id = $row_check['user_id'];	
			$user_email = $row_check['user_email'];	
		}	
		$response = "login success,".$user_id.",".$user_email;
	}
	
	echo $response;
	
	$conn->close();
?>
