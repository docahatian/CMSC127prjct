<?php
	include 'attendancefunctions.php';
	//connect_mysql();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "attendancedb";
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	
	//install tables
	create_tbl_events();
	create_tbl_attendees();
	create_tbl_users();
	
	//install sample data
	add_row_users("admin","password");
	
	/*
	HOW TO USE
	1.) delete/drop any database called "attendancedb"
	2.) create a new empty database called "attendancedb"
	3.) run this INSTALLER.php on localhost
	4.) you may now use the login.php and createaccount.php
	*/
	
	echo "Done...";
?>