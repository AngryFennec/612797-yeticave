<?php
require_once('connect.php');
require_once('functions.php');
require_once('connect.php');
require_once('data.php');
$categories = [];
$lots = [];
$user = !empty($_SESSION['user']) ? $_SESSION['user'] : [];


$sql_cat = "SELECT * FROM categories";
$result_cat = mysqli_query($con, $sql_cat);
if ($result_cat) {
    $categories = mysqli_fetch_all($result_cat, MYSQLI_ASSOC);
}

?>
