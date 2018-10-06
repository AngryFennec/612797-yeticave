<?php
require_once('functions.php');
require_once('data.php');

$is_auth = rand(0, 1);

$user_name = ''; // укажите здесь ваше имя
$user_avatar = 'img/user.jpg';

$con = mysqli_connect("localhost", "root", "", "612797-yeticave");
mysqli_set_charset($con, "utf8");
if ($con == false) {
    print("Ошибка подключения: " . mysqli_connect_error());
}
else {
    print("Соединение установлено");
    $sql = "SELECT category_id, class, cat_name FROM category";
    $result = mysqli_query($con, $sql);
    $categories_new = mysqli_fetch_all($result, MYSQLI_ASSOC);
}



$page_content = render_template('index.php', ['categories' => $categories_new, 'lots' => $lots]);
$layout_content = render_template('layout.php', ['page_content' => $page_content, 'title' => 'Главная', 'categories' => $categories_new, 'is_auth' => $is_auth, 'user_name' => $user_name, 'user_avatar' => $user_avatar]);
print($layout_content);
?>
