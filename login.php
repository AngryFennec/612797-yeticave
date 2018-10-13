<?php
    require_once('init.php');
    $errors = [];
    $data = [];
    if (!empty($_POST)) {

    $data = $_POST;
    $fields = ['email', 'password'];
    //валидация на обязательность
    foreach ($fields as $key) {
      if (empty($data[$key])) {
        $errors[$key] = 'Пожалуйста, заполните это поле';
      }
    }

    //проверка email и пароля
    if (!empty($data['email'])) {
        $email = mysqli_real_escape_string($con, $data['email']);
	    $sql = "SELECT * FROM users WHERE email = '" . $email. "'";
	    $res = mysqli_query($con, $sql);

	    $user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;

	    if (empty($errors) and $user) {
		    if (password_verify($data['password'], $user['password'])) {
                $_SESSION['user'] = $user;
            }
            else {
                $errors['password'] = 'Неверный пароль';
            }
        }
        else {
            $errors['email'] = 'Такой пользователь не найден';
        }
    }

    if (empty($errors)) {
            header("Location: index.php");

    }
} else {
    if (isset($_SESSION['user'])) {
        $page_content = render_template('layout.php', ['user' => $_SESSION['user']['name']]);
    }
    else {
        //$page_content = render_template('enter.php', []);
    }
}
    $page_content = render_template('login.php', ['categories' => $categories, 'errors' => $errors, 'data' => $data]);
    $layout_content = render_template('layout.php', ['page_content' => $page_content, 'title' => 'Главная', 'categories' => $categories, 'is_auth' => $is_auth, 'user_name' => $user_name, 'user_avatar' => $user_avatar]);
    print($layout_content);

    ?>
