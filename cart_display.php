<?php
//cart display
$_SESSION['cart'] = $cart;
echo "<p>
    <a href = 'cart.php'>My cart</a>: " . count($cart) .
"</p>";
//print_r($cart);
?>