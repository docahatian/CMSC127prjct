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
		break;
	}
?>