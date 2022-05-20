<?php
	$conn = mysqli_connect('localhost', 'Djewel', 'test123', 'events');

	if(!$conn){
		echo 'Connection Error: ' . mysqli_connect_error();
	}

	$sql = 'SELECT Event_ID, Event_Name, Username, User_ID, Number_of_attending_people, List_of_Names_of_people_attending, Time_to_Start, Time_to_End FROM event_created'; 

	$result = mysqli_query($conn, $sql);

	$events = mysqli_fetch_all($result, MYSQLI_ASSOC);

	mysqli_free_result($result);

	mysqli_close($conn);


?>

<!DOCTYPE html>
<html>
<head>
<title>Event Manager</title>
<link rel="stylesheet" href="Design_Event_Manager_UI.css">
</head>
<body>

<h1>Punctuality Tracker Database System</h1>
<!-- Tab Menu -->
	<div class="tab">
		<button class="tablinks" onclick="openTab(event, 'Create')">Create Event</button>
		<button class="tablinks" onclick="openTab(event, 'Edit')">Edit Event</button>
		<button class="tablinks" onclick="openTab(event, 'Delete')">Delete Event</button>
	</div>
<!-- Tab Content: List of Events to display and attend -->
	<?php  foreach($events as $event){ ?>

		<div class="col s6 md3">
			<div class="card z-depth-0">
				<div class="card-content center">
					Event Name: <?php echo htmlspecialchars($event['Event_Name']); ?>
					Name of creator: <?php echo htmlspecialchars($event['Username']); ?>
					Attendance <?php echo htmlspecialchars($event['List_of_Names_of_people_attending']); ?>
					Time: <?php echo htmlspecialchars($event['Time_to_Start']); ?>
					- <?php echo htmlspecialchars($event['Time_to_End']); ?>
				</div>
			</div>
		</div>

	<?php } ?>



<div id="Create" class="tabcontent">
	<span onclick="this.parentElement.style.display='none'" class="tablink">Close Tab</span>
<form><!-- Add php for create -->
	Name of event: <input type="text" name="event_name" required><br><br>
	Number of attendants: <input type="text" name="number_of_attendants" required><br><br>
	Names of attendants: <input type="text" name="names_of_attendants" required><br><br>
	Time of event to start (ex. 14:00:00): <input type="text" name="event_time_start" required><br><br>
	Time of event to end (ex. 18:00:00): <input type="text" name="event_time_end" required><br><br>
	<input type="submit" value="Submit">
</form>
</div>

<div id="Edit" class="tabcontent">
	<span onclick="this.parentElement.style.display='none'" class="tablink">Close Tab</span>
<form><!-- Add php for edit -->
	Name of existing event to edit: <input type="text" name="Find_existing_event" required><br><br>
	Edit name of event: <input type="text" name="Edit_name_of_event" required><br><br>
	Edit number of attendants: <input type="text" name="Edit_number_of_attendants" required><br><br>
	Edit names of attendants: <input type="text" name="Edit_names_of_attendants" required><br><br>
	Edit time of event to start (ex. 14:00:00): <input type="text" name="Edit_time_start" required><br><br>
	Edit time of event to end (ex. 18:00:00): <input type="text" name="Edit_time_end" required><br><br>
	<input type="submit" value="Submit edits">
</form>
</div>

<div id="Delete" class="tabcontent"><!-- Add php for delete -->
	<span onclick="this.parentElement.style.display='none'" class="tablink">Close Tab</span>
  <p>Name of existing event	<button onclick="">Delete</button></p>
  <p>Name of existing event	<button onclick="">Delete</button></p>
  <p>Name of existing event	<button onclick="">Delete</button></p>
</div>


<script src="Event_Tabs.js">
</script>
</body>
</html>
