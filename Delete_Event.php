<?php

    $conn = mysqli_connect('localhost', 'Djewel', 'test1234', 'events');

    if(!$conn){
    echo 'Connection Error: ' . mysqli_connect_error();
    }

        $Event_ID = $_POST['Event_ID_TBD'];

        $sql = "DELETE FROM event_created WHERE Event_ID = '$Event_ID' ";

        if(mysqli_query($conn, $sql)){
        header("Location: Event_Manager.php", true, 301);
        } else{
        echo 'query error: ' . mysqli_error($conn);
        }

?>