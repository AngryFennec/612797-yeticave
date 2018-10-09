<?php
require_once('connect.php');
require_once('functions.php');
require_once('connect.php');
require_once('data.php');
$categories = [];
$lots = [];
$is_auth = rand(0, 1);
$user_name = ''; // укажите здесь ваше имя
$user_avatar = 'img/user.jpg';



$sql_cat = "SELECT * FROM categories";
$result_cat = mysqli_query($con, $sql_cat);
if ($result_cat) {
    $categories = mysqli_fetch_all($result_cat, MYSQLI_ASSOC);
}

?>
