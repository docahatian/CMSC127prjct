<html>
<head>
<title>nffe account creation page</title>
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
<body style="background-image:url('https://images7.alphacoders.com/748/thumb-1920-748838.png');background-size:cover;overflow: hidden">

<div style="margin-left:40%;margin-right:40%;margin-top:20%;padding:1%;border:solid;background-color:#FFFFFF;display:flex;justify-content:center;align-items:center;">
<table>
	<th style="justify-content:center;align-items:center;">
		<h3>Create Account</h3>
	</th>
	<tr>
		<td colspan="1">Username:</td>
		<td colspan="2"><input id="un" type="text" name="username" value=""></td>
	</tr>
	<tr>
		<td colspan="1">Password:</td>
		<td colspan="2"><input id="pw" type="password" name="password" value=""></td>
	</tr>
	<tr>
		<td colspan="1">Account type:</td>
		<td colspan="1"><input type="radio" name="acctyp" value="0"><label for="acctyp">User</label></td>
		<td colspan="1"><input type="radio" name="acctyp" value="1"><label for="acctyp">Attendee</label></td>
	</tr>
	<tr>
		<td colspan="2"><button id="registerbutton">Register</button></td>
	</tr>
	<tr>
		<td colspan="2"><span id="registerstatus">...</span></td>
	</tr>
</table>
</div>



</body>
</html>


