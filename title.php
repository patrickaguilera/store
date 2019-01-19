<h1>
    <a href='index.php'>Welcome to Patrick's Store</a>
</h1>
<?php
session_start();

//establish a connection to the store database
$connection = mysqli_connect('localhost','root','root','store'); 

//check connection
if($connection->connect_error){
    die("Connection failed: " . $connection->connect_error);
}

//create cart
if(isset($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
}else{
    $cart = array();
}

//add to cart
if(isset($_GET['add_cart'])){
    $product = $_GET['add_cart'];
    array_push($cart, $product);
}
?>