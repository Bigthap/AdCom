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

    // Output moved to HTML body below
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save The World: Order Form</title>
    <link rel="stylesheet" href="product.css?v=<?php echo time(); ?>">
</head>

<body>

    <div class="header">
        <img src="Img/Hero2.jpg" alt="Recipe World Logo">
        <h3>Menu1</h3>
        <h3>Menu2</h3>
        <h3>Menu3</h3>
    </div>

  <div class="content-box">
        <h2>Order Summary</h2>
        <p> Total Price : <span style="color: red;"><?php echo "$cake (THB)"?></span><br>
            Shipment Type : <span style="color: red;"><?php echo "$ship ($s THB)"?></span><br>
            Discount: <span style="color: red;"><?php echo ($discount * 100) . "% (" . number_format($discountAmount, 2) . " THB)"; ?></span><br>
            <b>Net Price: <span style="color: red;"><?php echo number_format($netprice, 2); ?></span> THB</b><br>
            <h3>Thank You Very Much </h3>
        </p>
    </div>

</body>

</html>
