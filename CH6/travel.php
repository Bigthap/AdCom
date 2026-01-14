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
            if($n < 5){
                return ['air' => 1575,'hotel' => 240];
            }else{
                return ['air' => 1575-200,'hotel' => 240];
            }
        }
    }

    function stotal($a,$h,$p,$n){
        $airtotal = $a*$p;
        $hoteltotal = $h*$p*$n;
        return [$airtotal,$hoteltotal];
    }

    echo "<h1>Travel Reservation Report</h1>";
    echo "Destination: $city<br>";
    echo "Number of people: $people <br>";
    echo "Number of nights: $nights<br>";
    echo "Airline Ticket: $". number_format($airtotal,2) . "<br>";
    echo "Hotel Charges: $". number_format($hoteltotal,2) . "<br>";
    echo "============================<br>";
    echo "<h2>Total Cost: $".number_format($airtotal+$hoteltotal,2). "</h2>";

?>