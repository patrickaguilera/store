<html>
<head>
    <title>Search results</title>
</head>
<body>
<?php
require("title.php");
$search = $_SESSION['search'];
$query_str = "SELECT * FROM `products` JOIN `departments` ON
              `products`.`department_id` = `departments`.`department_id` 
              WHERE `name` LIKE '$search' OR `department_name` LIKE '$search'";

require("result_table.php");
require("cart_display.php");
?>