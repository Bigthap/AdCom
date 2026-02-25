<?php
$server = "localhost";
$user = "root";
$password = "";
$dbname = "682110065";

$connect = mysqli_connect($server, $user, $password, $dbname);

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
