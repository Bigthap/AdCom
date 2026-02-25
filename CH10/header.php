<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Database System</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<div id="header">
    <h1>Web Database System</h1>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php?page=position">Position</a></li>
        <li><a href="index.php?page=department">Department</a></li>
        <li><a href="index.php?page=systemuser">System-user</a></li>
        <li><a href="index.php?page=employee">Employee</a></li>
        <?php
        if (isset($_SESSION['username'])) {
            echo '<li><a href="Logout.php">Logout - </a>';
            echo "<span class='user-desc'>&nbsp;[";
            echo $_SESSION['firstname']
                ." ".$_SESSION['lastname']
                ." - Level: ".$_SESSION['level'];
            echo "]</span></li>";
        }
        else {
            echo '<li><a href="login.php">Login</a></li>';
        }
        ?>
    </ul>
</div>
<div id="content">
