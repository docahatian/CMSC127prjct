<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "attendancedb";
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if(!$conn){
		echo 'Connection Error: ' . mysqli_connect_error();
	}
			
			$Edit_target_event = $_POST['Find_existing_event'];
			$Edit_name_of_event = $_POST['Edit_name_of_event'];
			$Edit_number_of_attendants = $_POST['Edit_number_of_attendants'];
			$Edit_names_of_attendants = $_POST['Edit_names_of_attendants'];
			$Edit_time_start = $_POST['Edit_time_start'];
			$Edit_time_end = $_POST['Edit_time_end'];
			
			$sql = "UPDATE event_created SET Event_Name = '$Edit_name_of_event', Number_of_attending_people = '$Edit_number_of_attendants', List_of_names_of_people_attending = '$Edit_names_of_attendants', Time_to_Start = '$Edit_time_start', Time_to_End = '$Edit_time_end' WHERE Event_Name = '$Edit_target_event'";

			if(mysqli_query($conn, $sql)){
				header("Location: Event_Manager.php", true, 301);
			} else{
				echo 'query error: ' . mysqli_error($conn);
			}
	
 ?>