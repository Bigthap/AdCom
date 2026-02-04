<?php
    require_once "config.php";

    $PN = $_POST['PN'];
    $P = $_POST['P'];
    $QTY = $_POST['QTY'];


    $userQuery = "INSERT INTO product (productName, price, qty) VALUES ('$PN', '$P', $QTY)";
    $result = mysqli_query($connect, $userQuery);

    if (!$result)
    {
        die ("Could not successfully run the query $userQuery ".mysqli_error($connect));
    }
    else{
        echo "Successfully";
        echo "<a href=\"display_product.php\"><br>Add a new Product</a>";
    }