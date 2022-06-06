<?php
	include 'attendancefunctions.php';
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "attendancedb";
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	
	$sql = "SELECT * FROM users WHERE user_id LIKE ".$_SESSION['current_acc'];
	$result = @mysqli_query($conn,$sql);
	if (mysqli_num_rows($result) != 1){
		$sql = "SELECT * FROM attendees WHERE attendee_id LIKE ".$_SESSION['current_acc'];
		$result = @mysqli_query($conn,$sql);
		if (mysqli_num_rows($result) == 1){
			header("Location: attendee.php");
		}
		else{
			header("Location: login.php");
			//die ("no valid account found. ".$_SESSION['current_acc']);
		}
	}
?>
<html>
<head>
<title>nffe user page</title>
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
<body style="background-image:url('https://images7.alphacoders.com/748/thumb-1920-748838.png');background-size:cover;overflow: hidden">

<div style="margin-left:40%;margin-right:40%;margin-top:20%;padding:1%;border:solid;background-color:#FFFFFF;display:flex;justify-content:center;align-items:center;">
<table>
	<th style="justify-content:center;align-items:center;">
		<h3>User - WIP</h3>
		<table>
			<tr>
			<button id="logoutbutton">Logout</button>
			</tr>
		</table>
	</th>
</table>
</div>



</body>
</html>


