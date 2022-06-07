<?php
	include 'attendancefunctions.php';
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "attendancedb";
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	
	$sql = "SELECT * FROM attendees WHERE attendee_id LIKE ".$_SESSION['current_acc'];
	$result = @mysqli_query($conn,$sql);
	if (mysqli_num_rows($result) != 1){
		$sql = "SELECT * FROM users WHERE user_id LIKE ".$_SESSION['current_acc'];
		$result = @mysqli_query($conn,$sql);
		if (mysqli_num_rows($result) == 1){
			header("Location: user.php");
		}
		else{
			header("Location: login.php");
			//die ("no valid account found. ".$_SESSION['current_acc']);
		}
	}
?>
<html>
<head>
<title>Punctuality Tracker - Attendee</title>
<link rel="stylesheet" type="text/css" href="Design_attendee.css">
<script src="jquery.min.js"></script>
<script>
$(document).ready(function(){
	$("#logoutbutton").click(function(){
		$.post("valumin.php",{
			block: 2,
			v_01: "vo",
			v_02: "vo",
			v_03: "vo"
		},function(data,status){
			window.location.href = "login.php";
		});
	});
});
</script>
</head>
<body>

<div>
<table>
	<th>
		<h1>Punctuality Tracker - Attendee</h1>
		<h3>Attendee</h3>
		<button id="logoutbutton">Logout</button>
	</th>
</table>
</div>



</body>
</html>


