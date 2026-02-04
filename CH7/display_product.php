<?php
    require_once "config.php";

    $userQuery = "SELECT * FROM product";
    $result = mysqli_query($connect, $userQuery);

    if (!$result)
    {
        die ("Could not successfully run the query $userQuery ".mysqli_error($connect));
    }
    if (mysqli_num_rows($result) == 0)
    {
        echo "No records were found with query $userQuery";
    }

    echo "<a href=\"form_add_product.html\">Add a new Product</a><br><br>";
    echo "<table border = \"1\">";
    echo "<tr><th>Product Name</th><th>Price</th><th>Quantity</th></tr>";
    while($row = mysqli_fetch_assoc($result)){

        echo "<tr><td>". $row["productName"]."</td><td>".$row["price"]."</td><td>".$row["qty"]."</td></tr>";
    }
    echo "</table>";
?>