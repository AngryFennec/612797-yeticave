<?php
require_once('connect.php');
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

$sql_lot = "SELECT lot_id, name, c.cat_name, sum, img, end_date FROM lots l JOIN categories c ON l.category_id = c.category_id WHERE l.winner_id IS NULL ORDER BY l.init_date DESC LIMIT 6";
$result_lot = mysqli_query($con, $sql_lot);
if ($result_lot) {
    $lots = mysqli_fetch_all($result_lot, MYSQLI_ASSOC);
}
?>
