<?php
    $hour = $_POST['hour'];
    $work = $_POST['work'];

    echo "<h1>Wage Report</h1>";
    echo "Your hourly wage is  $$work and you worked $hour hours.<br>";
    echo "Your wages are $". $work*$hour ."<br>";

?>