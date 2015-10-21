<?php 
	date_default_timezone_set("Asia/Jakarta");
	include("config.php");
	
	$now = date("Y-m-d H:i:s");
	
	$email = $_REQUEST["email"];
	$password = $_REQUEST["password"];
			
	$sql_check = "SELECT * FROM user where user_email = '". $email."' and user_password = '". $password."'";
	$result_check = $conn->query($sql_check);
		
	if (@$result_check->num_rows > 0) {
		$response = "already registered";
	}			
	else{
	
		$sql_insertuser = "INSERT into user (user_email, user_password, user_created) VALUES ("."'".$email."','".$password."','".$now."')";
				
		if ($conn->query($sql_insertuser)){	
			$response = "register success";
		}	
		else{
			$response = "register failed";
		}
	}
	
	echo $response;
	
	$conn->close();
?>
