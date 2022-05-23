<?php 
	$conn = mysqli_connect('localhost', 'Djewel', 'test1234', 'events');

	if(!$conn){
		echo 'Connection Error: ' . mysqli_connect_error();
	}

			$Event_Name = $_POST['Event_Name'];
			$Number_of_attending_people = $_POST['Number_of_attending_people'];
			$List_of_Names_of_people_attending = $_POST['List_of_Names_of_people_attending'];
			$Time_to_Start = $_POST['Time_to_Start'];
			$Time_to_End = $_POST['Time_to_End'];

			$sql = "INSERT INTO event_created (Username, Event_Name, Number_of_attending_people, List_of_Names_of_people_attending, Time_to_Start, Time_to_End) VALUES ('Djewel', '$Event_Name', '$Number_of_attending_people', '$List_of_Names_of_people_attending', '$Time_to_Start', '$Time_to_End')";

			if(mysqli_query($conn, $sql)){
				header("Location: Event_Manager.php", true, 301);
			} else{
				echo 'query error: ' . mysqli_error($conn);
			}
	
 ?>