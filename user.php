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
	//echo $_SESSION['current_acc'];
?>
<html>
<head>
<title>Punctuality Tracker</title>
<link rel="stylesheet" type="text/css" href="Design_user.css">
<script src="jquery.min.js"></script>
<script>
	function vieweventlist(){
		$.post("valumin.php",{
			block: 4,
			v_01: "vo",
			v_02: "vo",
			v_03: "vo",
			v_04: "vo"
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
			v_03: ic,
			v_04: "vo"
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
	function deleteevent(del_id){
		$.post("valumin.php",{
			block: 6,
			v_01: del_id,
			v_02: "vo",
			v_03: "vo",
			v_04: "vo"
		},function(data,status){
			switch(data.trim()){
				case "delevent0":
					document.getElementById("userwindow").innerHTML = "Event deletion unauthorized!";
				break;
				case "delevent1":
					document.getElementById("userwindow").innerHTML = "Event deletion success!";
				break;
			}
		});
	}
	function editevent(edit_id){
		$.post("valumin.php",{
			block: 7,
			v_01: edit_id,
			v_02: "vo",
			v_03: "vo",
			v_04: "vo"
		},function(data,status){
			document.getElementById("userwindow").innerHTML = data;
		});
	}
	function editeventsubmit(edit_id){
		var ia = document.getElementById("ea").value;
		var ib = document.getElementById("eb").value;
		var ic = document.getElementById("ec").value;
		$.post("valumin.php",{
			block: 8,
			v_01: ia,
			v_02: ib,
			v_03: ic,
			v_04: edit_id
		},function(data,status){
			switch(data.trim()){
				case "editevent0":
					document.getElementById("userwindow").innerHTML = "Edit unauthorized!";
				break;
				case "editevent1":
					document.getElementById("userwindow").innerHTML = "Edit failed! Required fields not filled in!";
				break;
				case "editevent2":
					document.getElementById("userwindow").innerHTML = "Changes saved!";
				break;
			}
		});
	}
	function manageeventattendees(manage_id){
		$.post("valumin.php",{
			block: 9,
			v_01: manage_id,
			v_02: "vo",
			v_03: "vo",
			v_04: "vo"
		},function(data,status){
			document.getElementById("userwindow").innerHTML = data;
		});
	}
	function addattendee(ev_id){
		var na = document.getElementById("newattendee").value;
		$.post("valumin.php",{
			block: 10,
			v_01: ev_id,
			v_02: na,
			v_03: "vo",
			v_04: "vo"
		},function(data,status){
			switch(data.trim()){
				case "0":
					document.getElementById("userwindow").innerHTML = "Failed to add an attendee!";
				break;
				case "1":
					document.getElementById("userwindow").innerHTML = "Added an attendee!";
				break;
			}
		});
	}
	function removeattendee(e_id,a_id){
		$.post("valumin.php",{
			block: 13,
			v_01: e_id,
			v_02: a_id,
			v_03: "vo",
			v_04: "vo"
		},function(data,status){
		});
	}
$(document).ready(function(){
	vieweventlist();
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
	$("#createeventtab").click(function(){
		document.getElementById("userwindow").innerHTML = "<table id=\"Main\"><tr><td colspan=\"1\">Event Name:</td><td colspan=\"2\"><input id=\"ea\" type=\"text\" name=\"eea\" value=\"\"></td></tr><tr><td colspan=\"1\">Time Start:</td><td colspan=\"2\"><input id=\"eb\" type=\"text\" name=\"eeb\" value=\"\"></td></tr><tr><td colspan=\"1\">Time End:</td><td colspan=\"2\"><input id=\"ec\" type=\"text\" name=\"eec\" value=\"\"></td></tr><tr><td colspan=\"1\"></td><td colspan=\"1\"><button onclick=\"createeventsubmit()\">Create this Event</button></td><td colspan=\"1\"></td></tr></table>";
	});
});
</script>
</head>
<body>

<div id="Main">

<table>
	<th>
		<h1>Punctuality Tracker</h1>
		<h3>User</h3>
		<div id="button_main">
				<button id="createeventtab">Create Event</button>
				
				<button onclick="vieweventlist()">View Events</button>

				<button id="logoutbutton">Logout</button>
		</div>
		
	</th>
	
	<tr>

			<tr>
				<td><div id="userwindow">...</div></td>
			</tr>

	</tr>
</table>
</div>



</body>
</html>


