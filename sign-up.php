<?php
require_once('init.php');
$errors = [];
$data = [];
if (!empty($user)) {
  header("Location: index.php");
  exit();
}
if (!empty($_POST)) {
  foreach ($_POST as $key => $value) {
    $data[$key] = mysqli_real_escape_string($con, $_POST[$key]);
  }
  $fields = ['email', 'password', 'name', 'message'];
  //валидация на обязательность
  foreach ($fields as $key) {
    if (!empty($data[$key])) {
      $data[$key] = trim($data[$key]);
    }
    if (empty($data[$key])) {
      $errors[$key] = 'Пожалуйста, заполните это поле';
    }
  }
  //проверка email
  if (!empty($data['email'])) {
    $errors['email'] = validate_email($data['email'], $con);
  }
  if (empty($errors['name']) && strlen($data['name']) > 128) {
    $errors['name'] = 'Слишком длинное имя';
  }
  if (empty($errors['password']) && strlen($data['password']) > 64) {
    $errors['password'] = 'Слишком длинный пароль';
  }

  $path="";
  $tmp_name = "";
  if (is_uploaded_file($_FILES['photo2']['tmp_name'])) {
    $tmp_name = $_FILES['photo2']['tmp_name'];
    $file_type = mime_content_type($tmp_name);
    if ($file_type !== "image/jpeg" && $file_type !== "image/png") {
      $errors['photo2'] = 'Загрузите картинку в формате jpg/png';
    }
    $ftype = '';
    if ($file_type === "image/jpeg") {
      $ftype = ".jpg";
    }
    if ($file_type === "image/png") {\
      $ftype = ".png";
    }
    $path = 'img/' . uniqid() . $ftype;
  }
  if (empty($errors)) {
    if ($path != "") {
      move_uploaded_file($tmp_name,  $path);
    }
    $query = "INSERT INTO users SET init_date = NOW(), email = '". $data['email'] . "', name = '". $data['name'] . "', password = '" . password_hash($data['password'], PASSWORD_DEFAULT) . "', avatar = '" . $path . "', contacts = '" . $data['message'] . "'";
    $result = mysqli_query($con, $query);
    if ($result) {
      header("Location: login.php");
      exit();
    }
  }
}
$page_content = render_template('sign-up.php', ['categories' => $categories, 'errors' => $errors, 'data' => $data]);
$layout_content = render_template('layout.php', ['page_content' => $page_content, 'title' => 'Главная', 'categories' => $categories,   'user' => $user]);
print($layout_content);
?>
