<?php
    require_once('init.php');
    if (empty($_POST)) {
      $page_content = render_template('add.php', ['categories' => $categories]);
      $layout_content = render_template('layout.php', ['page_content' => $page_content, 'title' => 'Главная', 'categories' => $categories, 'is_auth' => $is_auth, 'user_name' => $user_name, 'user_avatar' => $user_avatar]);
      print($layout_content);
    } else {
    $data = $_POST;
    $errors = [];
    $fields = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
    foreach ($fields as $key) {
      if (empty($data[$key])) {
        $errors[$key] = 'Пожалуйста, заполните это поле';
      }
    } //валидация на обязательность
    if (!ctype_digit($data['lot-rate']) || $data['lot-rate'] <= 0) {
      $errors['lot_rate'] = 'В этом поле должно быть положительное число';
    }
    if (!ctype_digit($data['lot-step']) || $data['lot-step'] <= 0) {
      $errors['lot_step'] = 'В этом поле должно быть положительное число';
    }

    if (strtotime($data['lot-date']) < time()) {
      $errors['lot-date'] = 'Некорректная дата';
    }

    if (strlen($data['lot-name']) > 128) {
      $errors['lot-name'] = 'Слишком длинное имя';
    }

    $cat_flag = false;
	  foreach ($categories as $key => $value) {
		    if ($value['category_id'] == $data['category']) {
			       $cat_flag = true;
		    }
	   }
	   if (!$cat_flag) {
		     $errors['category'] = 'Выберите категорию';
	   }



    if (empty($errors)) {

      if (is_uploaded_file($_FILES['photo']['name'])) {
  		$tmp_name = $_FILES['photo']['tmp_name'];
  		$path = $_FILES['photo']['name'];

  		$finfo = finfo_open(FILEINFO_MIME_TYPE);
  		$file_type = finfo_file($finfo, $tmp_name);
  		  if ($file_type !== "image/jpeg" && $file_type !== "image/png") {
  			     $errors['image'] = 'Загрузите картинку в формате jpg/png';
  		  }
  		  else {
  			     move_uploaded_file($tmp_name, 'img/' . $path);
  			     $lot['image'] = $path;
  		  }
      }

      $query = "INSERT INTO `lots` SET
      `init_date` = date('Y-m-d H:i:s'),
      `name` = ". $data['lot-name'] . ",
      `end_date` = " . $data['lot-date'] . ",
      `bet_step` = " . $data['lot-step'] . ",
      `category_id` = " . $data['category'] . ",
      `description` = " . $data['message'] . ",
      `sum` = " . $data['lot-rate'] . ",
      `user_id` = 1,
      `winner_id` = NULL";

      $result = mysqli_query($con, $query);
      if ($result) {
          header("Location: lot.php?lot_id=" . mysqli_insert_id($con));
      }
    }
  }

    ?>
