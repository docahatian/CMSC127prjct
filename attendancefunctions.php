<?php
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "attendancedb";
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
	}
	//$_SESSION['current_acc'] = "";
	function create_db($dbname){
		/* not functional!
		$GLOBALS['dbname'] = $dbname;
		$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password']);
		$sql = "CREATE DATABASE $dbname;";
		if (mysqli_query($conn, $sql)) {
		}
		else {
		}*/
	}
	
	//=========================================REQUIRED TABLE CREATION FOR INSTALLATION=========================================
	function create_tbl_users(){
		$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		$sql = "CREATE TABLE users (
		user_id INT(30) NOT NULL, 
		username VARCHAR(30) NOT NULL,
		password VARCHAR(30) NOT NULL
		)";
		if (mysqli_query($conn, $sql)) {
		}
		else {
		}
	}
	function create_tbl_attendees(){
		$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		$sql = "CREATE TABLE attendees (
		attendee_id INT(30) NOT NULL, 
		username VARCHAR(30) NOT NULL,
		password VARCHAR(30) NOT NULL
		)";
		if (mysqli_query($conn, $sql)) {
		}
		else {
		}
	}
	function create_tbl_events(){
		$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		$sql = "CREATE TABLE events (
		event_id INT(30) NOT NULL,
		creator_user_id VARCHAR(10) NOT NULL,
		event_name VARCHAR(10) NOT NULL,
		attendance_list_id VARCHAR(10) NOT NULL,
		time_start VARCHAR(30) NOT NULL,
		time_end VARCHAR(30) NOT NULL
		)";
		if (mysqli_query($conn, $sql)) {
		}
		else {
		}
	}
	function create_tbl_attendance_list($attendance_list_id){
		$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		$sql = "CREATE TABLE al$attendance_list_id (
		user_id INT(30) NOT NULL,
		status TINYINT(2) NOT NULL
		)";
		if (mysqli_query($conn, $sql)) {
		}
		else {
		}
	}
	
	//=========================================ADDING ROWS TO TABLES=========================================
	function add_row_users($username, $password){
		$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		$id = 0;
		while(true){
			$sql = "SELECT user_id FROM users WHERE user_id LIKE $id";
			$result = @mysqli_query($conn, $sql);
			if(mysqli_num_rows($result) == 0){
				break;
			}
			else{
				$id = $id + 1;
			}
		}
		$sql = "INSERT INTO users (user_id, username, password)
		VALUES ('$id', '$username', '$password')";
		if (mysqli_query($conn, $sql)) {
		}
		else {
		}
	}
	function add_row_attendees($username, $password){
		$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		$id = 0;
		while(true){
			$sql = "SELECT attendee_id FROM attendees WHERE attendee_id LIKE $id";
			$result = @mysqli_query($conn, $sql);
			if(mysqli_num_rows($result) == 0){
				break;
			}
			else{
				$id = $id + 1;
			}
		}
		$sql = "INSERT INTO attendees (attendee_id, username, password)
		VALUES ('$id', '$username', '$password')";
		if (mysqli_query($conn, $sql)) {
		}
		else {
		}
	}
	function add_row_events($creator_user_id, $event_name, $time_start, $time_end){
		$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		$id = 0;
		while(true){
			$sql = "SELECT event_id FROM events WHERE event_id LIKE $id";
			$result = @mysqli_query($conn, $sql);
			if(mysqli_num_rows($result) == 0){
				break;
			}
			else{
				$id = $id + 1;
			}
		}
		$al_id = 0;
		//IMPORTANT - GET THE ID OF THE ATTENDANCE LIST AND ALSO MAKE IT
		$sql = "INSERT INTO events (event_id, creator_user_id, event_name, attendance_list_id, time_start, time_end)
		VALUES ('$id', '$creator_user_id', '$event_name', '$al_id', '$time_start', '$time_end')";
		if (mysqli_query($conn, $sql)) {
		}
		else {
		}
	}
	
	/*
	function add_row_compilation_archive($owner, $document_type, $month, $year, $raw){
		$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		$sql = "INSERT INTO compilationarchive (owner, document_type, month, year, raw)
		VALUES ('$owner', '$document_type', '$month', '$year', '$raw')";
		if (mysqli_query($conn, $sql)) {
		}
		else {
		}
	}
	
	function add_row_month($month_no, $month_name, $semester, $afteryear){
		$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		$sql = "INSERT INTO month (month_no, month_name, semester, afteryear)
		VALUES ('$month_no', '$month_name', '$semester', '$afteryear')";
		if (mysqli_query($conn, $sql)) {
		}
		else {
		}
	}
	function add_row_units($unit_head_teacher_id, $unit_name){
		$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		$unit_id = "";
		$rt = 0;
		for($c=0;$c<=999;$c++){
			$rt = 0;
			if ($c>=100){
				$unit_id = "u".$c;
			}
			else if($c>=10){
				$unit_id = "u0".$c;
			}
			else{
				$unit_id = "u00".$c;
			}
			$sql = "SELECT * FROM units WHERE unit_id LIKE '$unit_id'";
			$result = @mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) == 0){
				break;
			}
		}
		$sql = "INSERT INTO units (unit_id, unit_head_teacher_id, unit_name)
		VALUES ('$unit_id', '$unit_head_teacher_id', '$unit_name')";
		if (mysqli_query($conn, $sql)) {
		}
		else {
		}
	}
	function edit_unit($unit_head_teacher_id, $unit_name){
		$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		$unit_id = $_SESSION['reedit-unit'];
		$sql = "INSERT INTO units (unit_id, unit_head_teacher_id, unit_name)
		VALUES ('$unit_id', '$unit_head_teacher_id', '$unit_name')";
		if (mysqli_query($conn, $sql)) {
		}
		else {
		}
	}
	
	function no_unit_head(){
		$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}
		$sql = "SELECT * FROM units";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result)){
			$sqli = "SELECT * FROM teachers WHERE teacher_id LIKE '".$row[1]."' AND unit_id LIKE '".$row[0]."'";
			$resulti = mysqli_query($conn, $sqli);
			if (mysqli_num_rows($resulti) != 1){
				$sql = "DELETE FROM units WHERE unit_id LIKE '".$row[0]."'";
				if (mysqli_query($conn, $sql)) {
				}
				else {
				}
				$sql = "INSERT INTO units (unit_id, unit_head_teacher_id, unit_name, level_count)
				VALUES ('".$row[0]."', '---', '".$row[2]."', '".$row[3]."')";
				if (mysqli_query($conn, $sql)) {
				}
				else {
				}
			}
		}
	}
	*/
?>

