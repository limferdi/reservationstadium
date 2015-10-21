<?php

$dbhost = 'localhost';
$dbuser = 'navigatz_reserve';
$dbpass = 'P@ssw0rd';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die  ('Error connecting to mysql');

$dbname = 'navigatz_reservationstadium';
mysqli_select_db($conn,$dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 
?>