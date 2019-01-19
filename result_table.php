<?php
require("search_form.php");
echo "<h3>Showing results for '$search'</h3>
<form method = 'POST' action = '" . $_SERVER['PHP_SELF'] . "'>
<table border = '1' cellspacing = '0'>
    <tr>
        <td>Sort:</td>
        <td>
            <b>
                <a href = '?sort=name'>Product</a>
            </b>
        </td>
        <td>
            <b>
                <a href = '?sort=price'>Price</a>
            </b>
        </td>
        <td>
            <b>
                <a href = '?sort=inventory_count'># Available</a>
            </b>
        </td>
        <td>
            <b>Purchase</b>
        </td>
        <td>
        
        </tr>";
        
        if(isset($_GET['sort'])){
            $query_str .= "ORDER BY " . $_GET['sort'];
    }
    
    //retrieves data from database
    $query = mysqli_query($connection, $query_str);
    while($result=mysqli_fetch_array($query)){
        echo "<tr>
        <td></td>
        <td> " . $result['name'] . "</td>
        <td> $" . $result['price'] . "</td>
        <td> " . $result['inventory_count'] . "</td>
        <td>";
        if(in_array($result['product_id'], $cart)){
            echo "Added to Cart";
        }else{
            echo "<a href='?add_cart=" . $result['product_id'] . "'>
            Add to Cart?
            </a>";
        }
        echo "<td>
            <input list = 'quantity' name = 'quantity' 
            id = '" . $result['product_id'] . "'>
            <datalist id = 'quantity'>";
                for($i = 1; $i <= $result['inventory_count']; $i++){
                    echo "<option value = $i>";
                }
            echo "</datalist>
        </td>
        </tr>";
    }
    echo "</tr>
</table>
</form>";

//link to back home
echo "<a href = 'index.php'>Back to home</a>";

?>