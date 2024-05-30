<?php  
$sname = "sql109.infinityfree.com";
$uname = "if0_36128820";
$password = "aZhgKeZEnt";
$db_name = "if0_36128820_test_db";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
	exit();
}
