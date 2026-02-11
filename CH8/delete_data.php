<?php
    require_once "config.php";
    
    $travel_ID = $_GET['id']; //get $id from delete link
    
    $userQuery = "DELETE FROM travel WHERE travel_ID = '$travel_ID'";
    $result = mysqli_query($connect, $userQuery);
    
    if (!$result)
    {
        die ("Could not successfully run the query $userQuery ".mysqli_error($connect));
    }
    else
    {
        echo "Delete Successfully<br>";
        echo "<a href=\"display_report.php\">Back to list</a>";
    }
?>
