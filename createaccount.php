<html>
<head>
<title>Punctuality Tracker - Create Account</title>
<link rel="stylesheet" href="Design_createaccount.css">
<script src="jquery.min.js"></script>
<script>
$(document).ready(function(){
	function register(){
		var a = document.getElementById("un").value;
		var b = document.getElementById("pw").value;
		var c = $('input[name=acctyp]:checked').val();
		$.post("valumin.php",{
			block: 1,
			v_01: a,
			v_02: b,
			v_03: c
		},function(data,status){
			switch(data.trim()){
				case "create0":
					document.getElementById("registerstatus").innerHTML = "Input fields are not filled!";
				break;
				case "create1":
					document.getElementById("registerstatus").innerHTML = "User account created!";
				break;
				case "create2":
					document.getElementById("registerstatus").innerHTML = "Attendee account created!";
				break;
				case "create3":
					document.getElementById("registerstatus").innerHTML = "Username already taken!";
				break;
			}
		})
	}
	$(document).keypress(function(e) {
		if(e.which == 13){
			register();
		}
	});
	$("#registerbutton").click(function(){
		register();
	});
});
</script>
</head>
<body>

<div id="Table">

<table>
	<th id="TitleCard">
		<h1>Create Account</h1>
	</th>
	<tr>
		<td colspan="1">Username:
		<input id="un" type="text" name="username" value=""></td>
	</tr>
	<tr>
		<td colspan="1">Password:
		<input id="pw" type="password" name="password" value=""></td>
	</tr>
	<tr>
		<td colspan="1">Account type:
		<input type="radio" name="acctyp" value="0"><label for="acctyp">User</label>
		<input type="radio" name="acctyp" value="1"><label for="acctyp">Attendee</label></td>
	</tr>
	<tr>
		<td id="description">(User: Create, Edit, View, and delete events)</td>
	</tr>
	<tr>
		<td id="description">(Attendee: Confirm your attendance in an event)</td>
	</tr>

	<tr>
		<td colspan="2"><button id="registerbutton">Register</button></td>
	</tr>

	<tr>
		<td colspan="2"><span id="registerstatus"></span></td>
	</tr>
</table>
</div>



</body>
</html>


