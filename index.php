<html>
    <head>
        <title>Welcome!</title>
    </head>
    <body>
    <?php
    require("title.php");
    $_SESSION['cart'] = $cart;

    //row of products that may be appealing to guest
    echo "<h3>Check out some limited inventory products:</h3>";
    $query = mysqli_query($connection, //query for limited inventory products 
                        "SELECT * FROM `products` WHERE inventory_count < 20");
    
    //create table of results
    echo "<table border = '1' cellspacing = '5'>
    <tr>";
    while($result=mysqli_fetch_array($query)){
        echo "<td>" .
            $result['name'] . "<br>
            $" . $result['price'] . "<br>
            <i>only " . $result['inventory_count'] . " left!</i><br>";
            if(in_array($result['product_id'], $cart)){
                echo "Added to cart";
            }else{
                echo "<a href = '?add_cart=" . $result['product_id'] . "'>
                    Add to Cart?
                </a>";
            }
        echo "</td>";
    }
    echo "</tr>
    </table>
    <br>";

    require("search_form.php");

    echo "<h3>Or browse our wide range of departments:</h3>";
    //make list of departments
    $query = mysqli_query($connection, //query for departments
                          "SELECT `department_name` FROM `departments`
                           ORDER BY `department_id` ASC;");

    echo "<ul>";
    while($result=mysqli_fetch_array($query)){
        echo "<li>
        <a href='?department=" . $result['department_name'] . "'>". 
        $result['department_name'] . "</a>
        </li><br>";
    }
    echo "</ul>";

    //activates when user choses a department
    if(isset($_GET['department'])){
        $_SESSION['department'] = $_GET['department'];
        header("Location: department.php");
    }
    if(isset($_POST['submit'])){
        $_SESSION['search'] = $_POST['search'];
        header("Location: search.php");
    }
    //display cart size             
    require("cart_display.php");
    ?>
</body>
</html>