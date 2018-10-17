<?php
require_once('init.php');
if (empty($user)) {
    header("HTTP/1.0 403 Forbidden");
    print("403 Анонимный пользователь не может просматривать свои ставки");
    exit();
}
$sql_bet = "SELECT b.lot_id, b.user_id, u.winner_id, u.contacts, l.name, l.category_id, l.end_date, l.img, b.sum, b.init_date FROM bets b JOIN lots l ON l.lot_id = b.lot_id users u ON b.user_id = u.user_id WHERE b.user_id = " . $user['user_id'];
$result_bet = mysqli_query($con, $sql_bet);
if ($result_bet) {
    $my_bets = mysqli_fetch_all($result_bet, MYSQLI_ASSOC);
}

$page_content = render_template('my-lost.php', ['categories' => $categories, 'my_bets' => $my_bets]);
$layout_content = render_template('layout.php', ['page_content' => $page_content, 'title' => 'Мои ставки', 'categories' => $categories,  'user' => $user]);
print($layout_content);
?>
