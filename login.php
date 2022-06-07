<?php
	include 'attendancefunctions.php';
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "attendancedb";
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
?>
<html>
<head>
<title>Punctuality Tracker - Login</title>
<link rel="stylesheet" href="Design_login.css">
<script src="jquery.min.js"></script>
<script>
$.post("valumin.php",{
	block: 5,
	v_01: "login",
	v_02: "vo",
	v_03: "vo"
},function(data,status){
	switch(data.trim()){
		case "gotologin":{
			window.location.href = "login.php";
		}
		break;
		case "gotouser":{
			window.location.href = "user.php";
		}
		break;
		case "gotoattendee":{
			window.location.href = "attendee.php";
		}
		break;
	}
});
$(document).ready(function(){
	function login(){
		var a = document.getElementById("un").value;
		var b = document.getElementById("pw").value;
		$.post("valumin.php",{
			block: 0,
			v_01: a,
			v_02: b,
			v_03: "vo"
		},function(data,status){
			switch(data.trim()){
				case "login0":
					document.getElementById("loginstatus").innerHTML = "Login credentials are incomplete!";
				break;
				case "login1":
					document.getElementById("loginstatus").innerHTML = "User login successful.";
					window.location.href = "user.php";
				break;
				case "login2":
					document.getElementById("loginstatus").innerHTML = "Attendee login successful.";
					window.location.href = "attendee.php";
				break;
				case "login3":
					document.getElementById("loginstatus").innerHTML = "Login credentials are incorrect!";
				break;
				default:
					alert(data);
				break;
			}
		});
	}
	$(document).keypress(function(e) {
		if(e.which == 13){
			login();
		}
	});
	$("#loginbutton").click(function(){
		login();
	});
});
</script>
</head>
<body>
<div id="Table">
	<div id="TitleCard">
		<h1>Punctuality Tracker System</h1>
	</div>
<table>
	<tr>
		<td colspan="1">Username:</td>
		<td colspan="2"><input id="un" type="text" name="username" value=""></td>
	</tr>
	<tr>
		<td colspan="1">Password:</td>
		<td colspan="2"><input id="pw" type="password" name="password" value=""></td>
	</tr>
	<tr>
		<td colspan="1"></td>
		<td colspan="1"><button id="loginbutton">Log In</button></td>
		<td colspan="1"></td>
	</tr>
	<tr>
		<td colspan="3"><span id="loginstatus"></span></td>
	</tr>
</table>
</div>



</body>
</html>
