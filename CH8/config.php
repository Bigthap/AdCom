<?php
    $server = "localhost";
    $user= "root";
    $password = "";
    $dbname="682110065";

    $connect = mysqli_connect ($server, $user, $password, $dbname);
    if (!$connect)
    {
        die ("ERROR: Cannot connect to the database $dbname on server $server
        using username $user (" .mysqli_connect_error(). ", " .mysqli_connect_error(). ")");
    }
?>