<?php
    require_once('init.php');
    $page_content = render_template('add.php', ['categories' => $categories, 'lot' => $lot]);
    $layout_content = render_template('layout.php', ['page_content' => $page_content, 'title' => 'Главная', 'categories' => $categories, 'is_auth' => $is_auth, 'user_name' => $user_name, 'user_avatar' => $user_avatar]);
    print($layout_content);

    $data = $_POST;
    $errors = [];
    $fields = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date']
    foreach ($fields as $key) {
      if (empty($data[$key]) {
        $errors[$key] = 'Пожалуйста, заполните это поле';
      }
    }
    if (!ctype_digit($fields['lot-rate'])) {
      $errors['lot_rate'] = 'В этом поле должны быть только цифры'
    }
    if (!ctype_digit($fields['lot-step'])) {
      $errors['lot_step'] = 'В этом поле должны быть только цифры'
    }

     $data['photo2'] = get_uploaded_file_name('image');

     $query = "INSERT INTO lots SET "


    ?>
