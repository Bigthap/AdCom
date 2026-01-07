<?php
    $q1 = $_POST['q1'];
    $q2 = $_POST['q2'];
    $q3 = $_POST['q3'];

    $cake1 = 450 * $q1;
    $cake2 = 570 * $q2;
    $cake3 = 630 * $q3;
    $cake = $cake1 + $cake2 + $cake3;

    $ship = $_POST['shipping'];
    if($ship == 'Flash'){
        $s = 40;
    }elseif($ship == 'EMS'){
        $s = 50;
    }else{
        $s = 60;
    }

    if($cake > 5000){
        $discount = 0.15;
    }elseif($cake > 3000){
        $discount = 0.1;
    }else{
        $discount = 0.05;
    }

    $discountAmount = $cake * $discount;
    $netprice = ($cake - $discountAmount) + $s;

    echo "Total Price: " . number_format($cake) . " THB<br>";
    echo "Discount: " . ($discount * 100) . "% (" . number_format($discountAmount) . " THB)<br>";
    echo "Shipping ($ship): $s THB<br>";
    echo "<b>Net Price: " . number_format($netprice) . " THB</b>";
?>