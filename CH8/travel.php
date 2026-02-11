<?php
    $city = $_POST['city'];
    $people = $_POST['people'];
    $nights = $_POST['nights'];
    $air = all($city,$nights)['air'];
    $hotel = all($city,$nights)['hotel'];
    [$airtotal,$hoteltotal] = stotal($air,$hotel,$people,$nights);


    function all($a,$n){
        if($a == 'Barcelona'){
            return ['air' => 875,'hotel' => 85];
        }elseif($a == 'Cairo'){
            return ['air' => 950,'hotel' => 98];
        }elseif($a == 'Rome'){
            return ['air' => 875,'hotel' => 110];
        }elseif($a == 'Santiago'){
            return ['air' => 820,'hotel' => 85];
        }
        else{
            return ['air' => 1575,'hotel' => 240];
        }
    }

    function stotal($a,$h,$p,$n){
        $airtotal = $a*$p;
        $hoteltotal = $h*$p*$n;
        return [$airtotal,$hoteltotal];
    }
    $total = $airtotal+$hoteltotal;
    require_once "config.php";


    $userQuery = "INSERT INTO travel (Destination, NumberOfNights, NumberOfPeople, HotelPrice, TicketPrice, TotalPrice) 
    VALUES ('$city', $nights, $people, $hoteltotal, $airtotal, $total)";
    $result = mysqli_query($connect, $userQuery);

    if (!$result)
    {
        die ("Could not successfully run the query $userQuery ".mysqli_error($connect));
    }
    else{
        echo "Successfully";
        echo "<a href=\"display_report.php\"><br>Add a new record</a>";
    }

?>