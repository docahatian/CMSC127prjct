<?php 
	$conn = mysqli_connect('localhost', 'Djewel', 'test1234', 'events');

	if(!$conn){
		echo 'Connection Error: ' . mysqli_connect_error();
	}

	$Event_Name = $Number_of_attending_people = $List_of_Names_of_people_attending = $Time_to_Start = $Time_to_End = '';
	$error = array('Event_Name'=>'', 'Number_of_attending_people'=>'', 'List_of_Names_of_people_attending'=>'', 'Time_to_Start'=>'', 'Time_to_End'=>'');

	if(isset($_POST['submit'])){
		//Checks name of event
		if(empty($_POST['Event_Name'])){
			$error['Event_Name'] = 'Name of event is required <br />';
		} else{
			$Event_Name = $_POST['Event_Name'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $Event_Name)){
				$error['Event_Name'] = 'Name of event must be letters and spaces only';
			}
		}
		//Checks number of attendants
		if(empty($_POST['Number_of_attending_people'])){
			$error['Number_of_attending_people'] = 'Name of event is required <br />';
		} else{
			$Number_of_attending_people = $_POST['Number_of_attending_people'];
			if(!is_numeric($Number_of_attending_people)){
				$error['Number_of_attending_people'] = 'Number of attendants must be a number only';
			}
		}
		//Checks names of attendants
		if(empty($_POST['List_of_Names_of_people_attending'])){
			$error['List_of_Names_of_people_attending'] = 'Name of event is required <br />';
		} else{
			$List_of_Names_of_people_attending = $_POST['List_of_Names_of_people_attending'];
			if(!preg_match('/^[a-zA-Z\s]+(,\s*[a-zA-Z\s]*)*$/', $List_of_Names_of_people_attending)){
				$error['List_of_Names_of_people_attending'] = 'Names of attendants must be a coma separated list';
			}
		}
		//Checks the start time of event
		if(empty($_POST['Time_to_Start'])){
			$error['Time_to_Start'] = 'Start Time is required <br />';
		} else{
			$Time_to_Start = $_POST['Time_to_Start'];
			if(!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $Time_to_Start)){
				$error['Time_to_Start'] = 'Start Time must follow HH:MM::SS format';
			}
		}
		//Checks the end time of event
		if(empty($_POST['Time_to_End'])){
			$error['Time_to_End'] = 'Name of event is required <br />';
		} else{
			$Time_to_End = $_POST['Time_to_End'];
			if(!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $Time_to_End)){
				$error['Time_to_End'] = 'End Time must follow HH:MM::SS format';
			}
		}

		
			$Event_Name = mysqli_real_escape_string($conn, $_POST['Event_Name']);
			$Number_of_attending_people = mysqli_real_escape_string($conn, $_POST['Number_of_attending_people']);
			$List_of_Names_of_people_attending = mysqli_real_escape_string($conn, $_POST['List_of_Names_of_people_attending']);
			$Time_to_Start = mysqli_real_escape_string($conn, $_POST['Time_to_Start']);
			$Time_to_End = mysqli_real_escape_string($conn, $_POST['Time_to_End']);

			$sql = "INSERT INTO event_created(Event_Name, Number_of_attending_people, List_of_Names_of_people_attending, Time_to_Start, Time_to_End) VALUES('$Event_Name', '$Number_of_attending_people', '$List_of_Names_of_people_attending', '$Time_to_Start', '$Time_to_End')";

			if(mysqli_query($conn, $sql)){
				header('Location: Event_Manager.php');
			} else{
				echo 'query error: ' . mysqli_error($conn);
			}

		

	}
 ?>