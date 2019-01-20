<?php
if(isset($_POST['submit'])){
    $_SESSION['search'] = $_POST['search'];
    header("Location: search.php");
}

echo "<form method = 'POST' action = '" . $_SERVER['PHP_SELF'] . "'>
    <input name = 'search' type = 'text' placeholder = 'Search for Products'>
    <input type = 'submit' name = 'submit'>
</form>";
?>