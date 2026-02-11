<?php
    require_once "config.php";

    $userQuery = "SELECT * FROM travel";
    $result = mysqli_query($connect, $userQuery);

    if (!$result)
    {
        die ("Could not successfully run the query $userQuery ".mysqli_error($connect));
    }
    if (mysqli_num_rows($result) == 0)
    {
        echo "No records were found with query $userQuery";
    }

    echo "<a href=\"travel.html\">Add a new report</a><br><br>";
    echo "<table border = \"1\">";
    echo "<tr><th>Destination</th>
        <th>NumberOfNights</th>
        <th>NumberOfPeople</th>
        <th>HotelPrice</th>
        <th>TicketPrice</th>
        <th>TotalPrice</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>";
    while($row = mysqli_fetch_assoc($result)){

        echo "<tr><td>". $row["Destination"]."</td><td>"
        .$row["NumberOfNights"]."</td><td>"
        .$row["NumberOfPeople"]."</td><td>"
        .$row["HotelPrice"]."</td><td>"
        .$row["TicketPrice"]."</td><td>"
        .$row["TotalPrice"]."</td>";
        
        echo "<td><a href=\"update_data.php?id=".$row['travel_ID']."\">";
        echo "Update</a></td>";
        echo "<td><a href=\"delete_data.php?id=".$row['travel_ID']."\">";
        echo "Delete</a></td></tr>";
    }
    echo "</table>";
?>