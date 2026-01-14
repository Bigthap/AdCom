<?php
    $os = $_POST['os'];
    $c = $_POST['copies'];

    function ship($c){
        if($c < 5){
            return 3.5;
        }else{
            return 3.5 + (($c-4)*0.75);
        }

    }
    function stotal($c){
        $stotal = $c * 35;
        return $stotal;
    }
    function tax($stotal){
        return $stotal * 0.07;
    }

    echo "<h1>Save The World: Order Details</h1>";
    echo "Operating System: Macintosh<br>";
    echo "Number of copies: $c <br>";
    echo "============================<br>";
    echo "Sub-total: $". number_format(stotal($c),2) . "<br>";
    echo "Tax: $". number_format(tax(stotal($c)),2) . "<br>";
    echo "Shipping cost: $". number_format(ship($c),2) . "<br>";
    echo "============================<br>";
    echo "Total: $".number_format(stotal($c)+tax(stotal($c))+ship($c),2). "<br>";

?>