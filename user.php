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
	echo $_SESSION['current_acc'];
?>
<html>
<head>
<title>nffe user page</title>
<script src="jquery.min.js"></script>
<script>
	function vieweventlist(){
		$.post("valumin.php",{
			block: 4,
			v_01: "vo",
			v_02: "vo",
			v_03: "vo"
		},function(data,status){
			document.getElementById("userwindow").innerHTML = data;
		});
	}
	function createeventsubmit(){
		var ia = document.getElementById("ea").value;
		var ib = document.getElementById("eb").value;
		var ic = document.getElementById("ec").value;
		$.post("valumin.php",{
			block: 3,
			v_01: ia,
			v_02: ib,
			v_03: ic
		},function(data,status){
			switch(data.trim()){
				case "addevent0":
					document.getElementById("userwindow").innerHTML = "<table><tr><td colspan=\"1\">Event Name:</td><td colspan=\"2\"><input id=\"ea\" type=\"text\" name=\"eea\" value=\"\"></td></tr><tr><td colspan=\"1\">Time Start:</td><td colspan=\"2\"><input id=\"eb\" type=\"text\" name=\"eeb\" value=\"\"></td></tr><tr><td colspan=\"1\">Time End:</td><td colspan=\"2\"><input id=\"ec\" type=\"text\" name=\"eec\" value=\"\"></td></tr><tr><td colspan=\"3\">Event creation failed! Required field/s were left blank!</td></tr><tr><td colspan=\"1\"></td><td colspan=\"1\"><button onclick=\"createeventsubmit()\">Create this Event</button></td><td colspan=\"1\"></td></tr></table>";
				break;
				case "addevent1":
					document.getElementById("userwindow").innerHTML = "<table><tr><td colspan=\"1\">Event Name:</td><td colspan=\"2\"><input id=\"ea\" type=\"text\" name=\"eea\" value=\"\"></td></tr><tr><td colspan=\"1\">Time Start:</td><td colspan=\"2\"><input id=\"eb\" type=\"text\" name=\"eeb\" value=\"\"></td></tr><tr><td colspan=\"1\">Time End:</td><td colspan=\"2\"><input id=\"ec\" type=\"text\" name=\"eec\" value=\"\"></td></tr><tr><td colspan=\"3\">Event creation success!</td></tr><tr><td colspan=\"1\"></td><td colspan=\"1\"><button onclick=\"createeventsubmit()\">Create this Event</button></td><td colspan=\"1\"></td></tr></table>";
				break;
			}
		});
	}
$(document).ready(function(){
	vieweventlist();
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
	$("#createeventtab").click(function(){
		document.getElementById("userwindow").innerHTML = "<table><tr><td colspan=\"1\">Event Name:</td><td colspan=\"2\"><input id=\"ea\" type=\"text\" name=\"eea\" value=\"\"></td></tr><tr><td colspan=\"1\">Time Start:</td><td colspan=\"2\"><input id=\"eb\" type=\"text\" name=\"eeb\" value=\"\"></td></tr><tr><td colspan=\"1\">Time End:</td><td colspan=\"2\"><input id=\"ec\" type=\"text\" name=\"eec\" value=\"\"></td></tr><tr><td colspan=\"1\"></td><td colspan=\"1\"><button onclick=\"createeventsubmit()\">Create this Event</button></td><td colspan=\"1\"></td></tr></table>";
	});/*
	$("#createeventsubmit").click(function(){
		alert("l");
		var ia = document.getElementById("ea").value;
		var ib = document.getElementById("eb").value;
		var ic = document.getElementById("ec").value;
		$.post("valumin.php",{
			block: 3,
			v_01: ia,
			v_02: ib,
			v_03: ic
		},function(data,status){
			switch(data.trim()){
				case "addevent0":
					document.getElementById("userwindow").innerHTML = "<table><tr><td colspan=\"1\">Event Name:</td><td colspan=\"2\"><input id=\"ea\" type=\"text\" name=\"eea\" value=\"\"></td></tr><tr><td colspan=\"1\">Time Start:</td><td colspan=\"2\"><input id=\"eb\" type=\"text\" name=\"eeb\" value=\"\"></td></tr><tr><td colspan=\"1\">Time End:</td><td colspan=\"2\"><input id=\"ec\" type=\"text\" name=\"eec\" value=\"\"></td></tr><tr><td colspan=\"3\">Event creation failed! Required field/s were left blank!</td></tr><tr><td colspan=\"1\"></td><td colspan=\"1\"><button id=\"createeventsubmit\">Create this Event</button></td><td colspan=\"1\"></td></tr></table>";
				break;
				case "addevent1":
					document.getElementById("userwindow").innerHTML = "<table><tr><td colspan=\"1\">Event Name:</td><td colspan=\"2\"><input id=\"ea\" type=\"text\" name=\"eea\" value=\"\"></td></tr><tr><td colspan=\"1\">Time Start:</td><td colspan=\"2\"><input id=\"eb\" type=\"text\" name=\"eeb\" value=\"\"></td></tr><tr><td colspan=\"1\">Time End:</td><td colspan=\"2\"><input id=\"ec\" type=\"text\" name=\"eec\" value=\"\"></td></tr><tr><td colspan=\"3\">Event creation success!</td></tr><tr><td colspan=\"1\"></td><td colspan=\"1\"><button id=\"createeventsubmit\">Create this Event</button></td><td colspan=\"1\"></td></tr></table>";
				break;
			}
		});
	});*/
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
				<td><button id="createeventtab">Create Event</button></td>
				<td><button onclick="vieweventlist()">View Events</button></td>
				<td><button id="logoutbutton">Logout</button></td>
			</tr>
			<tr>
			<td><div id="userwindow">...</div></td>
			</tr>
		</table>
	</th>
</table>
</div>



</body>
</html>


