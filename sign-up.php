<?php
    require_once('init.php');
    $errors = [];
    $data = [];
    session_start();
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : [];
    if (!empty($user)) {
        header("Location: index.php");
    }
    if (!empty($_POST)) {

    $data = $_POST;
    $fields = ['email', 'password', 'name', 'message'];
    //валидация на обязательность
    foreach ($fields as $key) {
      if (empty($data[$key])) {
        $errors[$key] = 'Пожалуйста, заполните это поле';
      }
    }
    //проверка email
    if (!empty($data['email'])) {
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
		          $errors['email'] = 'Введен несуществующий адрес!';
	    } else {
            $email = mysqli_real_escape_string($con, $data['email']);
            $sql = "SELECT user_id FROM users WHERE email = '" . $email. "'";
            $res = mysqli_query($con, $sql);
            if ($res && mysqli_num_rows($res) > 0) {
                $errors['email'] = 'Пользователь с этим email уже зарегистрирован';
            }
	   }
       if (strlen($data['email']) > 128) {
         $errors['email'] = 'Слишком длинный адрес';
       }
   }

    if (empty($errors['name']) && strlen($data['name']) > 128) {
      $errors['name'] = 'Слишком длинное имя';
    }
    if (empty($errors['password']) && strlen($data['password']) > 64) {
      $errors['password'] = 'Слишком длинный пароль';
    }

    $path="";
    $tmp_name = "";

       if (!empty($data['photo2'])) {
   		$tmp_name = $_FILES['photo2']['tmp_name'];
   		$file_type = mime_content_type($tmp_name);
   		 if ($file_type !== "image/jpeg" && $file_type !== "image/png") {
   			     $errors['photo2'] = 'Загрузите картинку в формате jpg/png';
   		  }
          $ftype = '';
          print($file_type);
          if ($file_type == "image/jpeg") {
              $ftype = ".jpg";
          }
          if ($file_type == "image/png") {
              $ftype = ".png";
          }
          $path = 'img/' . uniqid() . $ftype;
      }

    if (empty($errors)) {
        if (!empty($data['photo2'])) {
            move_uploaded_file($tmp_name,  $path);
        }
        $query = "INSERT INTO users SET init_date = NOW(), email = '". $data['email'] . "', name = '". $data['name'] . "', password = '" . password_hash($data['password'], PASSWORD_DEFAULT) . "', avatar = '" . $path . "', contacts = '" . $data['message'] . "'";
        print($query);
        $result = mysqli_query($con, $query);
        if ($result) {
            header("Location: login.php");
        }
    }
}
    $page_content = render_template('sign-up.php', ['categories' => $categories, 'errors' => $errors, 'data' => $data]);
    $layout_content = render_template('layout.php', ['page_content' => $page_content, 'title' => 'Главная', 'categories' => $categories,   'user' => $user]);
    print($layout_content);

    ?>
