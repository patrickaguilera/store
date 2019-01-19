<?php
require("title.php");
echo "<h2>My Cart:</h2>";

//display all items in cart
if(empty($cart)){
    echo "<p>
    <i>Nothing in cart</i>
    </p>";
}else{
    //remove items from cart
    if(isset($_GET['remove_cart'])){
        $cart = array_diff($cart, [$_GET['remove_cart']]);
        $_SESSION['cart'] = $cart;
    }

    //query the database
    $total = 0;
    $query_str = "SELECT * FROM `products` WHERE ";
    foreach($cart as $key => $item){
        $query_str .= "`product_id` = " . $item . " OR ";
    }
    $query_str = rtrim($query_str, " OR ");

    //build cart table
    echo "<table border = 1>
        <tr>
            <td>
                <b>Item name</b>
            </td>
            <td>
                <b>Price</b>
            </td>
            <td>
                <b>Remove From Cart</b>
            </td>
        </tr>";
        $query = mysqli_query($connection, $query_str);
        $inventory_arr = array();
        while($result = mysqli_fetch_array($query)){
            echo "<tr>
                <td>" . $result['name'] . "</td>
                <td>$" . $result['price'] . "</td>
                <td>
                    <a href = '?remove_cart=" . $result['product_id'] . "'>
                        remove?
                    </a>
                </td>
            </tr>";
            $total += $result['price'];
            array_push($inventory_arr, $result['inventory_count']);
        }
    echo "</table>
    <br>
    <table border = '1'>
        <tr>
            <td>
                <p>Subtotal: $" . round($total, 2) . "</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>H.S.T (13%): $" . round($total * 1.13 - $total, 2) . "</p>
            </td>
        </tr>
        <tr>
            <td>
                <b>Total: $" . round($total * 1.13, 2) . "</b>
            </td>
        </tr>
    </table>";

    //checkout
    if(isset($_GET['checkout'])){
        $query_str = "";
        foreach($inventory_arr as $key => $stock){
            $stock -= 1;
            $query_str .= "UPDATE `products` SET `inventory_count` = '$stock'
                           WHERE `product_id` = " . $cart[$key] . "; ";
        }
        mysqli_query($connection, $query_str);
        $cart = array();
        session_destroy();
        header("Location: index.php");
    }

    //buttons
    echo "<a href = '?checkout=1'>Checkout</a><br><br>
    <a href = 'index.php'>Back to home</a>";
}
