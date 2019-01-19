<?php

require("title.php");
$search = $_SESSION['department'];
echo "<html>
<head>
<title>$search</title>
</head>
<body>";

//selects all products from chosen department
$query_str = "SELECT * FROM `products` JOIN `departments` ON
               `products`.`department_id` = `departments`.`department_id`
               WHERE `department_name` = '" . $search . "'";
    
//table column titles
require("result_table.php");

//display cart
require("cart_display.php");
?>
