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
<title>nffe attendee page</title>
<script src="jquery.min.js"></script>
<script>
function showattandableevents(){
	$.post("valumin.php",{
		block: 11,
		v_01: "vo",
		v_02: "vo",
		v_03: "vo",
		v_04: "vo"
	},function(data,status){
		document.getElementById("userwindow").innerHTML = data;
	});
}
function attend(ev_id){
	$.post("valumin.php",{
		block: 12,
		v_01: ev_id,
		v_02: "vo",
		v_03: "vo",
		v_04: "vo"
	},function(data,status){
		document.getElementById("userwindow").innerHTML = data;
	});
}
showattandableevents();
$(document).ready(function(){
	$("#logoutbutton").click(function(){
		$.post("valumin.php",{
			block: 2,
			v_01: "vo",
			v_02: "vo",
			v_03: "vo",
			v_04: "vo"
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
		<h3>Attendee - WIP</h3>
		<table>
			<tr>
				<td><button id="logoutbutton">Logout</button></td>
			</tr>
			<tr>
				<td><div id="userwindow"></div></td>
			</tr>
		</table>
	</th>
</table>
</div>



</body>
</html>


