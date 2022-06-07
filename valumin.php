<?php
	include 'attendancefunctions.php';
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "attendancedb";
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	
	//block 1 - login.php login with existing account
	$v_00 = $_POST["block"];
	$v_01 = $_POST["v_01"];
	$v_02 = $_POST["v_02"];
	$v_03 = $_POST["v_03"];
	$v_04 = $_POST["v_04"];
	
	switch($v_00){
		case 0:{//login
			if (!isset($v_01) || trim($v_01) == '' || !isset($v_02) || trim($v_02) == '') {
				echo "login0";//no credentials
			}
			else{
				$sql = "SELECT * FROM users WHERE username LIKE '$v_01' AND password LIKE '$v_02'";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) == 1) {
					echo "login1";//start a user session with the user_id according to the username and password
					while($row = mysqli_fetch_row($result)){
						$_SESSION['current_acc'] = $row[0];
					}
				}
				else{
					$sql = "SELECT * FROM attendees WHERE username LIKE '$v_01' AND password LIKE '$v_02'";
					$result = mysqli_query($conn, $sql);
					if (mysqli_num_rows($result) == 1) {
						echo "login2";//start an attendee session with the attendee_id according to the username and password
						while($row = mysqli_fetch_row($result)){
							$_SESSION['current_acc'] = $row[0];
						}
					}
					else{
						echo "login3";//invalid credentials
					}
				}
			}
		}
		break;
		case 1:{//create account
			if (!isset($v_01) || trim($v_01) == '' || !isset($v_02) || trim($v_02) == '' || $v_03 > 1 || $v_03 < 0) {
				echo "create0";//no credentials
			}
			else{
				$sql = "SELECT username FROM users WHERE username LIKE '$v_01'";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) == 0) {
					$sql = "SELECT username FROM attendees WHERE username LIKE '$v_01'";
					$result = mysqli_query($conn, $sql);
					if (mysqli_num_rows($result) == 0){
						if($v_03 == 0){
							add_row_users($v_01, $v_02);
							echo "create1";
						}
						else if($v_03 == 1){
							add_row_attendees($v_01, $v_02);
							echo "create2";
						}
					}
					else{
						echo "create3";
					}
				}
				else{
					echo "create3";
				}
			}
		}
		break;
		case 2:{//logout
			$_SESSION['current_acc'] = "";
		}
		break;
		case 3:{//create event
			if (!isset($v_01) || trim($v_01) == '') {
				echo "addevent0";//incomplete
			}
			else{
				echo "addevent1";//all good
				add_row_events($v_01, $v_02, $v_03);
			}
		}
		break;
		case 4:{//view events
			$total = "<table style=\"border: 1px solid\">";
			$sql = "SELECT * FROM events WHERE creator_user_id LIKE '".$_SESSION['current_acc']."'";
			$result = mysqli_query($conn, $sql);
			$total = $total."<tr style=\"border: 1px solid\"><td>Event Name</td><td>Start Time</td><td>End Time</td><td></td><td></td><td></td></tr>";
			while($row = mysqli_fetch_row($result)){
				$total = $total."<tr style=\"border: 1px solid\"><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td><button onclick=\"editevent(".$row[0].")\">Edit</button></td><td><button onclick=\"deleteevent(".$row[0].")\">Delete</button></td><td><button onclick=\"manageeventattendees(".$row[0].")\">Manage Attendees</button></td></tr>";
			}
			$total = $total."</table>";
			echo $total;
		}
		break;
		case 5:{//redirect according to $_SESSION['current_acc']. for now only important so that errors wont show up in login page, probably not necessary for the other two so it wont be implemented, just written here.
			switch($v_01){
				case "login":{
					$sql = "SELECT * FROM users WHERE user_id LIKE '".$_SESSION['current_acc']."'";
					$result = @mysqli_query($conn,$sql);
					if (mysqli_num_rows($result) == 1){
						echo "gotouser";
						//header("Location: user.php");
					}
					$sql = "SELECT * FROM attendees WHERE attendee_id LIKE '".$_SESSION['current_acc']."'";
					$result = @mysqli_query($conn,$sql);
					if (mysqli_num_rows($result) == 1){
						echo "gotoattendee";
						//header("Location: attendee.php");
					}
				}
				break;
				case "user":{
					$sql = "SELECT * FROM users WHERE user_id LIKE ".$_SESSION['current_acc'];
					$result = @mysqli_query($conn,$sql);
					if (mysqli_num_rows($result) != 1){
						$sql = "SELECT * FROM attendees WHERE attendee_id LIKE ".$_SESSION['current_acc'];
						$result = @mysqli_query($conn,$sql);
						if (mysqli_num_rows($result) == 1){
							echo "gotoattendee";
							//header("Location: attendee.php");
						}
						else{
							echo "gotologin";
							//header("Location: login.php");
							//die ("no valid account found. ".$_SESSION['current_acc']);
						}
					}
				}
				break;
				case "attendee":{
					$sql = "SELECT * FROM attendees WHERE attendee_id LIKE ".$_SESSION['current_acc'];
					$result = @mysqli_query($conn,$sql);
					if (mysqli_num_rows($result) != 1){
						$sql = "SELECT * FROM users WHERE user_id LIKE ".$_SESSION['current_acc'];
						$result = @mysqli_query($conn,$sql);
						if (mysqli_num_rows($result) == 1){
							echo "gotouser";
							//header("Location: user.php");
						}
						else{
							echo "gotologin";
							//header("Location: login.php");
							//die ("no valid account found. ".$_SESSION['current_acc']);
						}
					}
				}
				break;
			}
		}
		break;
		case 6:{//delete event
			$sql = "SELECT * FROM events WHERE event_id LIKE $v_01 AND creator_user_id LIKE ".$_SESSION['current_acc'];
			$result = @mysqli_query($conn,$sql);
			if (mysqli_num_rows($result) == 1){
				$sql = "DELETE FROM events WHERE event_id LIKE $v_01 AND creator_user_id LIKE ".$_SESSION['current_acc'];
				if (mysqli_query($conn, $sql)) {
				}
				else {
				}
				$sql = "DROP TABLE al$v_01";
				if (mysqli_query($conn, $sql)) {
				}
				else {
				}
				echo "delevent1";//delete success
			}
			else{
				echo "delevent0";//unauthorized
			}
		}
		break;
		case 7:{//edit event (for filling in the fields)
			$sql = "SELECT * FROM events WHERE event_id LIKE $v_01 AND creator_user_id LIKE ".$_SESSION['current_acc'];
			$result = @mysqli_query($conn,$sql);
			if (mysqli_num_rows($result) != 1){
				echo "Unauthorized to edit this event!";
			}
			else{
				while($row = mysqli_fetch_row($result)){
					echo "<table><tr><td colspan=\"1\">Event Name:</td><td colspan=\"2\"><input id=\"ea\" type=\"text\" name=\"eea\" value=\"".$row[2]."\"></td></tr><tr><td colspan=\"1\">Time Start:</td><td colspan=\"2\"><input id=\"eb\" type=\"text\" name=\"eeb\" value=\"".$row[3]."\"></td></tr><tr><td colspan=\"1\">Time End:</td><td colspan=\"2\"><input id=\"ec\" type=\"text\" name=\"eec\" value=\"".$row[4]."\"></td></tr><tr><td colspan=\"1\"></td><td colspan=\"1\"><button onclick=\"editeventsubmit(".$row[0].")\">Save Changes</button></td><td colspan=\"1\"></td></tr></table>";
				}
			}
		}
		break;
		case 8:{//edit event (for actually editing the thing itself)
			$sql = "SELECT * FROM events WHERE event_id LIKE $v_04 AND creator_user_id LIKE ".$_SESSION['current_acc'];
			$result = @mysqli_query($conn,$sql);
			if (mysqli_num_rows($result) != 1){
				echo "editevent0";//unauthorized
			}
			else if (!isset($v_01) || trim($v_01) == ''){
				echo "editevent1";//incomplete
			}
			else{
				$sql = "UPDATE events SET event_name = '$v_01', time_start = '$v_02', time_end = '$v_03' WHERE event_id LIKE $v_04 AND creator_user_id LIKE ".$_SESSION['current_acc'];
				if (mysqli_query($conn, $sql)) {
				}
				else {
				}
				echo "editevent2";//all good
			}
		}
		break;
		case 9:{//view attendees for event
			$en = "";//event name
			$sql = "SELECT * FROM events WHERE event_id LIKE $v_01 AND creator_user_id LIKE ".$_SESSION['current_acc'];
			$result = @mysqli_query($conn,$sql);
			if (mysqli_num_rows($result) != 1){
				echo "viewattendees0";//unauthorized
			}
			else{
				while($row = mysqli_fetch_row($result)){
					$en = $row[2];
				}
			}
			$total = "Attendees for event $en <br><table style=\"border: 1px solid\"><tr style=\"border: 1px solid\"><td>Attendee</td><td>Status</td><td></td></tr>";
			$sql = "SELECT * FROM al$v_01";
			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_row($result)){
				$name = "";
				$status = "";
				$sqli = "SELECT username FROM attendees WHERE attendee_id LIKE ".$row[0];
				$resulti = mysqli_query($conn, $sqli);
				while($rowi = mysqli_fetch_row($resulti)){
					$name = $rowi[0];
				}
				switch($row[1]){
					case 0:{
						$status = "Not Attended";
					}
					break;
					case 1:{
						$status = "Attended";
					}
					break;
				}
				$total = $total."<tr style=\"border: 1px solid\"><td>$name</td><td>$status</td><td><button onclick=\"removeattendee($v_01,".$row[0].")\">Remove Attendee</button></td></tr>";
			}
			$total = $total."<tr><td><input id=\"newattendee\" type=\"text\" value=\"\" placeholder=\"Type Attendee username...\"><button onclick=\"addattendee($v_01)\">Add Attendee</button></td></tr></table>";
			echo $total;
		}
		break;
		case 10:{//add attendee
			$sql = "SELECT * FROM events WHERE event_id LIKE $v_01 AND creator_user_id LIKE ".$_SESSION['current_acc'];
			$sqli = "SELECT attendee_id FROM attendees WHERE username LIKE '$v_02'";
			$result = @mysqli_query($conn,$sql);
			$result_sub = @mysqli_query($conn,$sqli);
			if (mysqli_num_rows($result) != 1 || mysqli_num_rows($result_sub) != 1){
				echo "0";//unauthorized
			}
			else{
				$sql = "SELECT attendee_id FROM attendees WHERE username LIKE '$v_02'";
				$result = @mysqli_query($conn,$sql);
				while($row = mysqli_fetch_row($result)){
					$sqli = "INSERT INTO al$v_01 (user_id, status)
					VALUES (".$row[0].", 0)";
					if (mysqli_query($conn, $sqli)) {
					}
					else {
					}
				}
				echo "1";//success
			}
		}
		break;
		case 11:{//events
			$total = "<table><tr><td>Event Name</td><td></td></tr>";
			$sql = "SELECT * FROM events";
			$result = @mysqli_query($conn,$sql);
			while($row = mysqli_fetch_row($result)){
				$sqli = "SELECT * FROM al".$row[0]." WHERE user_id LIKE ".$_SESSION['current_acc']." AND status LIKE 0";
				$resulti = @mysqli_query($conn,$sqli);
				if (mysqli_num_rows($resulti) == 1){
					$total = $total."<tr><td>".$row[1]."</td><td><button onclick=\"attend(".$row[0].")\">Attend</button></td></tr>";
				}
			}
			$total = $total."</table>";
			echo $total;
		}
		break;
		case 12:{
			$sql = "SELECT * FROM al$v_01 WHERE user_id LIKE ".$_SESSION['current_acc'];
			$result = @mysqli_query($conn,$sql);
			if (mysqli_num_rows($result) == 1){
				$sql = "UPDATE al$v_01 SET status = 1 WHERE user_id LIKE ".$_SESSION['current_acc'];
				if (mysqli_query($conn, $sqli)) {
				}
				else {
				}
			}
		}
		break;
		case 13:{
			$sql = "SELECT * FROM events WHERE event_id LIKE $v_01 AND creator_user_id LIKE ".$_SESSION['current_acc'];
			$result = @mysqli_query($conn,$sql);
			if (mysqli_num_rows($result) == 1){
				$sql = "DELETE FROM al$v_01 WHERE user_id LIKE $v_02";
				if (mysqli_query($conn, $sqli)) {
				}
				else {
				}
			}
		}
		break;
	}
?>