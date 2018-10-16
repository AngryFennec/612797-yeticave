<?php
  require_once('init.php');
  $lot_id = 0;
  $lot = [];
  $bets = [];
  $errors = [];
  $data = [];

  if (isset($_GET['lot_id'])) {
    $lot_id = intval($_GET['lot_id']);
  }
  $sql = "SELECT lot_id, user_id, name, sum, img, bet_step, end_date,  description, cat_name  FROM lots l JOIN categories c ON l.category_id = c.category_id WHERE lot_id = " . $lot_id;
  $result = mysqli_query($con, $sql);
  if ($result) {
    $lot = mysqli_fetch_array($result, MYSQLI_ASSOC);
  }
  if (!$lot) {
    header("HTTP/1.0 404 Not Found");
    print("404 ой!");
    exit();
  }
  $bets = get_bets($lot, $con);
  if (!empty($_POST) && !empty($user)) {
    foreach ($_POST as $key => $value) {
      $data[$key] = mysqli_real_escape_string($con, $_POST[$key]);
    }
    if (!empty($data['cost'])) {
      $data['cost'] = trim($data['cost']);
    }
    //валидация на обязательность
    if (empty($data['cost'])) {
      $errors['cost'] = 'Пожалуйста, заполните это поле';
    }
    if (empty($errors['cost']) && (!ctype_digit($data['cost']) || $data['cost'] <= 0)) {
      $errors['cost'] = 'В этом поле должно быть положительное число';
    }
    if (empty($errors['cost']) && (time() >= strtotime($lot['end_date']))) {
      $errors['cost'] = 'Время истекло';
    }
    if (empty($errors['cost']) && (is_already_bet($user, $bets))) {
      $errors['cost'] = 'Вы уже делали ставку на этот лот';
    }
    if (empty($errors['cost']) && ($data['cost'] <= (get_max_bet($bets, $lot) + $lot['bet_step']))) {
      $errors['cost'] = 'Ставка должна быть больше существующей';
    }
    if (empty($errors['cost']) && !empty($lot)) {
      $query = "INSERT INTO bets SET init_date = NOW(), lot_id = '". $lot['lot_id'] . "', sum = '" . $data['cost'] . "', user_id = '" . $user['user_id'] . "'";
      $result = mysqli_query($con, $query);
      if ($result) {
        header("Location: lot.php?lot_id=" . $lot['lot_id']);
        exit();
      }
    }
  }
  $page_content = render_template('lot.php', ['categories' => $categories, 'lot' => $lot, 'user' => $user, 'bets' => $bets]);
  $layout_content = render_template('layout.php', ['page_content' => $page_content, 'title' => 'Главная', 'categories' => $categories, 'user' => $user]);
  print($layout_content);
?>
