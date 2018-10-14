<?php
    require_once('init.php');
    $errors = [];
    $data = [];
    session_start();
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : [];
    if (empty($user)) {
        header("HTTP/1.0 403 Forbidden");
        print("403 Анонимный пользователь не может добавлять лот");
        exit();
    }

    if (!empty($_POST)) {

    $data = $_POST;
    $fields = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
    foreach ($fields as $key) {
      if (empty($data[$key])) {
        $errors[$key] = 'Пожалуйста, заполните это поле';
      }
    } //валидация на обязательность
    if (empty($errors['lot-rate']) && (!ctype_digit($data['lot-rate']) || $data['lot-rate'] <= 0)) {
      $errors['lot-rate'] = 'В этом поле должно быть положительное число';
    }
    if (empty($errors['lot-step']) && (!ctype_digit($data['lot-step']) || $data['lot-step'] <= 0)) {
      $errors['lot-step'] = 'В этом поле должно быть положительное число';
    }

    if (empty($errors['lot-date']) && strtotime($data['lot-date']) < time()) {
      $errors['lot-date'] = 'Некорректная дата';
    }

    if (empty($errors['lot-name']) && strlen($data['lot-name']) > 128) {
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

       if (is_uploaded_file($_FILES['photo']['tmp_name'])) {
   		$tmp_name = $_FILES['photo']['tmp_name'];
   		$file_type = mime_content_type($tmp_name);
   		  if ($file_type !== "image/jpeg" && $file_type !== "image/png") {
   			     $errors['photo'] = 'Загрузите картинку в формате jpg/png';
   		  }
          $ftype = '';
          if ($file_type == "image/jpeg") {
              $ftype = ".jpg";
          }
          if ($file_type == "image/png") {
              $ftype = ".png";
          }
          $path = uniqid() . $ftype;

  		  if ($file_type !== "image/jpeg" && $file_type !== "image/png") {
  			     $errors['image'] = 'Загрузите картинку в формате jpg/png';
  		  }

      } else {
          var_dump($errors);
          $errors['photo'] = 'Вы не загрузили файл';
      }


    if (empty($errors)) {
      move_uploaded_file($tmp_name, 'img/' . $path);

      $query = "INSERT INTO lots SET init_date = NOW(), name = '". $data['lot-name'] . "', end_date = '" . $data['lot-date'] . "', bet_step = '" . $data['lot-step'] . "', category_id = '" . $data['category'] . "', img = '" . 'img/' . $path . "', description = '" . $data['message'] . "', sum = '" . $data['lot-rate'] . "', user_id = '" . $user['user_id'] . "', winner_id = NULL";
      $result = mysqli_query($con, $query);
      if ($result) {

          header("Location: lot.php?lot_id=" . mysqli_insert_id($con));
      }
    }
}
    $page_content = render_template('add.php', ['categories' => $categories, 'errors' => $errors, 'data' => $data]);
    $layout_content = render_template('layout.php', ['page_content' => $page_content, 'title' => 'Главная', 'categories' => $categories,   'user' => $user]);
    print($layout_content);

    ?>
