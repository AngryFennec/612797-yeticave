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
        $fields = ['email', 'password'];
        //валидация на обязательность
        foreach ($fields as $key) {
          if (!empty($data[$key])) {
            $data[$key] = trim($data[$key]);
          }
          if (empty($data[$key])) {
            $errors[$key] = 'Пожалуйста, заполните это поле';
          }
        }

        //проверка email и пароля
        if (!empty($data['email'])) {
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
              $errors['email'] = 'Введите валидный email';
            } else {
            $email = mysqli_real_escape_string($con, $data['email']);
    	    $sql = "SELECT * FROM users WHERE email = '" . $email. "'";
    	    $res = mysqli_query($con, $sql);

    	    $user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;

    	    if (empty($errors) and $user) {
    		    if (password_verify($data['password'], $user['password'])) {
                    $_SESSION['user'] = $user;
                    header("Location: index.php");
                    exit();
                }
                else {
                    $errors['password'] = 'Неверный пароль';
                }
            }
            else {
                $errors['email'] = 'Такой пользователь не найден';
            }
        }
        }
    }


    $page_content = render_template('login.php', ['categories' => $categories, 'errors' => $errors, 'data' => $data]);
    $layout_content = render_template('layout.php', ['page_content' => $page_content, 'title' => 'Главная', 'categories' => $categories, 'user' => $user]);
    print($layout_content);

    ?>
