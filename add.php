<?php
    require_once('init.php');
    $errors = [];
    $data = [];
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

       if (!empty($data['photo']) && mime_content_type($_FILES['photo']['tmp_name'])) {
   		$tmp_name = $_FILES['photo']['tmp_name'];
   		$path = $_FILES['photo']['name'];

   		$finfo = finfo_open(FILEINFO_MIME_TYPE);
   		$file_type = finfo_file($finfo, $tmp_name);
   		  if ($file_type !== "image/jpeg" && $file_type !== "image/png") {
   			     $errors['photo'] = 'Загрузите картинку в формате jpg/png';
   		  }

      } else {
          $errors['photo'] = 'Вы не загрузили файл';
      }


    if (empty($errors)) {
      move_uploaded_file($tmp_name, 'img/' . $path);
      $lot['img'] = 'img/' . $path;

      $query = "INSERT INTO lots SET init_date = NOW(), name = '". $data['lot-name'] . "', end_date = '" . $data['lot-date'] . "', bet_step = '" . $data['lot-step'] . "', category_id = '" . $data['category'] . "', img = '" . 'img/' . $path . "', description = '" . $data['message'] . "', sum = '" . $data['lot-rate'] . "', user_id = 1, winner_id = NULL";

      $result = mysqli_query($con, $query);
      if ($result) {

          header("Location: lot.php?lot_id=" . mysqli_insert_id($con));
      }
    }
}
    $page_content = render_template('add.php', ['categories' => $categories, 'errors' => $errors, 'data' => $data]);
    $layout_content = render_template('layout.php', ['page_content' => $page_content, 'title' => 'Главная', 'categories' => $categories, 'is_auth' => $is_auth, 'user_name' => $user_name, 'user_avatar' => $user_avatar]);
    print($layout_content);

    ?>
