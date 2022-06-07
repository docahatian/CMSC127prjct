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
		case 3:{//create event
			if (!isset($v_01) || trim($v_01) == '') {
				echo "addevent0";//incomplete
			}
			else{
				echo "addevent1";//all good
				add_row_events($v_01, $v_02, $v_03);
			}
		}
		case 4:{//view events
			$total = "<table style=\"border: 1px solid\">";
			$sql = "SELECT * FROM events WHERE creator_user_id LIKE '".$_SESSION['current_acc']."'";
			$result = mysqli_query($conn, $sql);
			$total = $total."<tr style=\"border: 1px solid\"><td>Event Name</td><td>Start Time</td><td>End Time</td><td></td><td></td><td></td></tr>";
			while($row = mysqli_fetch_row($result)){
				$total = $total."<tr style=\"border: 1px solid\"><td>".$row[2]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td><button>Edit</button></td><td><button>Delete</button></td><td><button>Manage Attendees</button></td></tr>";
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
	}
?>