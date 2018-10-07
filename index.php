<?php
require_once('functions.php');
require_once('data.php');

$is_auth = rand(0, 1);

$user_name = ''; // укажите здесь ваше имя
$user_avatar = 'img/user.jpg';

$con = mysqli_connect("localhost", "root", "", "612797_yeticave");
mysqli_set_charset($con, "utf8");
if ($con == false) {
    print("Ошибка подключения: " . mysqli_connect_error());
}
else {
    $sql_cat = "SELECT * FROM categories";
    $result_cat = mysqli_query($con, $sql_cat);
    if ($result_cat) {
        $categories_new = mysqli_fetch_all($result_cat, MYSQLI_ASSOC);
    }

    $sql_lot = "SELECT name, c.cat_name, sum, img, end_date FROM lots l JOIN categories c ON l.category_id = c.category_id WHERE l.winner_id IS NULL ORDER BY l.init_date DESC LIMIT 6";
    $result_lot = mysqli_query($con, $sql_lot);
    if ($result_lot) {
        $lots_new = mysqli_fetch_all($result_lot, MYSQLI_ASSOC);
    }

}




$page_content = render_template('index.php', ['categories' => $categories_new, 'lots' => $lots_new]);
$layout_content = render_template('layout.php', ['page_content' => $page_content, 'title' => 'Главная', 'categories' => $categories_new, 'is_auth' => $is_auth, 'user_name' => $user_name, 'user_avatar' => $user_avatar]);
print($layout_content);
?>
