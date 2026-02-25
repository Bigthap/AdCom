<?php
    require_once "config.php";
    
    $travel_ID = $_GET['id'];
    $Destination = $_POST['Destination'];
    $NumberOfNights = $_POST['NumberOfNights'];
    $NumberOfPeople = $_POST['NumberOfPeople'];
    $HotelPrice = $_POST['HotelPrice'];
    $TicketPrice = $_POST['TicketPrice'];
    $TotalPrice = $_POST['TotalPrice'];

    
    $userQuery = "UPDATE travel SET 
        Destination = '$Destination',
        NumberOfNights = $NumberOfNights,
        NumberOfPeople = $NumberOfPeople,
        HotelPrice = $HotelPrice,
        TicketPrice = $TicketPrice,
        TotalPrice = $TotalPrice
        WHERE travel_ID = '$travel_ID'";
    
    $result = mysqli_query($connect, $userQuery);
    
    if (!$result)
    {
        die ("Could not successfully run the query $userQuery ".mysqli_error($connect));
    }
    else
    {
        echo "Update Successfully<br>";
        echo "<a href=\"display_report.php\">Back to list</a>";
    }
?>
