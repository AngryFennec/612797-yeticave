<?php
    require_once('functions.php');
    require_once('connect.php');
    require_once('data.php');
    require_once('init.php');
    $lot_id = 0;
    $lot = [];
    if (isset($_GET['lot_id'])) {
      $lot_id = intval($_GET['lot_id']);
    }
    if (!$lot_id) {
        print("404");
        exit();
    }
    else {
        $sql = "SELECT name, sum, img, description, cat_name  FROM lots l JOIN categories c ON l.category_id = c.category_id WHERE lot_id = " . $lot_id;
        $result = mysqli_query($con, $sql);
        if ($result) {
            $lot = mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }

    $page_content = render_template('lot.php', ['categories' => $categories, 'lot' => $lot]);
    $layout_content = render_template('layout.php', ['page_content' => $page_content, 'title' => 'Главная', 'categories' => $categories, 'is_auth' => $is_auth, 'user_name' => $user_name, 'user_avatar' => $user_avatar]);
    print($layout_content);

?>
