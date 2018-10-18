<?php
require_once('init.php');
$finished = [];
$query = "SELECT l.name, l.sum, l.img, c.cat_name, u.email, b.user_id AS 'bet_winner', COUNT(b.bet_id) AS 'bet_count', COALESCE(MAX(b.sum), l.sum) as 'greatest'FROM lots l JOIN categories c ON l.category_id = c.category_id JOIN users u ON u.user_id = b.user_id LEFT JOIN bets b ON l.lot_id = b.lot_id WHERE l.winner_id IS NULL GROUP BY l.lot_id ORDER BY l.init_date";
if ($result_lot) {
  $finished = mysqli_fetch_all($result_lot, MYSQLI_ASSOC);
}
foreach ($finished as $val) {
  if ($val['sum'] !== $val['greatest']) {
    $sql = mysql_query("INSERT INTO lots (`winner_id`) VALUES ('" .$val['bet_winner']. "')");
    $to = $val['email'];
    $subject = 'Ваша ставка выиграла';
    $message = 'Ура! Ваша ставка ' . $greatest ."выиграла в борьбе за лот " . $val['name'];
    $headers = 'From: yeti@eyeticave.com';
    mail($to, $subject, $message, $headers);
  }
}

?>
