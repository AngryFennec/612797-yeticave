<?php
    require_once('init.php');
    $page_content = render_template('add.php', ['categories' => $categories, 'lot' => $lot]);
    $layout_content = render_template('layout.php', ['page_content' => $page_content, 'title' => 'Главная', 'categories' => $categories, 'is_auth' => $is_auth, 'user_name' => $user_name, 'user_avatar' => $user_avatar]);
    print($layout_content);
    ?>
