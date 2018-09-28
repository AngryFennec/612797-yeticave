<?php
require_once('functions.php');
require_once('data.php');

$is_auth = rand(0, 1);

$user_name = ''; // укажите здесь ваше имя
$user_avatar = 'img/user.jpg';

$page_content = render_template('index.php', ['categories' => $categories, 'lots' => $lots]);
$layout_content = render_template('layout.php', ['page_content' => $page_content, 'title' => 'Главная', 'categories' => $categories, 'is_auth' => $is_auth, 'user_name' => $user_name, 'user_avatar' => $user_avatar]);
print($layout_content);
?>
