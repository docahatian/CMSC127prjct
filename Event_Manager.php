<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "attendancedb";
	$conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if(!$conn){
		echo 'Connection Error: ' . mysqli_connect_error();
	}

	$sql = 'SELECT event_id, creator_user_id, event_name, attendance_list_id, time_start, time_end FROM events'; 

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
<p></p>
<!-- Tab Menu -->
	<div class="tab">
		<button value = "Create Event" class="tablinks" onclick="openTab(event, 'Create')">Create Event</button>
		<button value = "Edit Event" class="tablinks" onclick="openTab(event, 'Edit')">Edit Event</button>
		<button value = "Delete Event" class="tablinks" onclick="openTab(event, 'Delete')">Delete Event</button>
	</div>
<!-- Tab Content: List of Events to display and attend -->
<div id="Event_List" class="tabcontent_list">
	<?php  foreach($events as $event){ ?>
	Event ID: <?php echo htmlspecialchars($event['event_id']); ?>
	Name of creator: <?php echo htmlspecialchars($event['Username']); ?>
		Time: <?php echo htmlspecialchars($event['time_start']); ?>
	- <?php echo htmlspecialchars($event['time_end']); ?>

<?php echo "<br>"; ?>

	<?php } ?>
</div>


<div id="Create" class="tabcontent">
<form action="Create_Event.php" method="POST"><!-- Add php for create -->
	Name of event: <input type="text" name="Event_Name" required><br><br>
	Number of attendants: <input type="text" name="Number_of_attending_people" required><br><br>
	Names of attendants: <input type="text" name="List_of_Names_of_people_attending" required><br><br>
	Time of event to start (ex. 14:00:00): <input type="text" name="Time_to_Start" required><br><br>
	Time of event to end (ex. 18:00:00): <input type="text" name="Time_to_End" required><br><br>
	<input type="submit" value="Submit">
</form>
</div>

<div id="Edit" class="tabcontent">
<form><!-- Add php for edit -->
	Name of existing event to edit: <input type="text" name="Find_existing_event" required><br><br>
	Edit name of event: <input type="text" name="Edit_name_of_event" required><br><br>
	Edit number of attendants: <input type="text" name="Edit_number_of_attendants" required><br><br>
	Edit names of attendants: <input type="text" name="Edit_names_of_attendants" required><br><br>
	Edit time of event to start (ex. 14:00:00): <input type="text" name="Edit_time_start" required><br><br>
	Edit time of event to end (ex. 18:00:00): <input type="text" name="Edit_time_end" required><br><br>
	<input type="submit" value="Submit Edits">
</form>
</div>

<div id="Delete" class="tabcontent"><!-- Add php for delete -->
<form action="Delete_Event.php" method="POST">
  <?php  foreach($events as $event){ ?>
	Event Name: <?php echo htmlspecialchars($event['Event_Name']); print("\t\t")?>
<?php echo "<br>"; ?>
	<?php } ?>
	<?php echo "<br>"; ?>
	Input Event ID: <input type="text" name="Event_ID_TBD" size="2" required><br>
	<input type="submit" value="Delete">
	</form>
</div>

<script src="Event_Tabs.js">
</script>
</body>
</html>
