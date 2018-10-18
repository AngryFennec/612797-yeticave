<?php
require_once('vendor/autoload.php');
$finished = [];
$query = "SELECT * from lots l WHERE winner_id IS NULL AND end_date < NOW()";
$result_lot = mysqli_query($con, $query);
if ($result_lot) {
  $finished = mysqli_fetch_all($result_lot, MYSQLI_ASSOC);
  $transport = (new Swift_SmtpTransport('phpdemo.ru', 25));
  $transport->setUsername('keks@phpdemo.ru');
  $transport->setPassword('htmlacademy');

  foreach ($finished as $val) {
      $current_lot = $val['lot_id'];
      $bet_query = "SELECT b.lot_id, b.sum, b.user_id, u.email, u.name FROM bets b JOIN users u ON b.user_id = u.user_id WHERE b.lot_id = " . $current_lot . " ORDER BY b.sum DESC LIMIT 1";
      $result_bet = mysqli_query($con, $bet_query);
      if ($result_bet) {
          $max_bet = mysqli_fetch_all($result_bet, MYSQLI_ASSOC);
          if (!empty($max_bet)) {
              $max_bet = $max_bet[0];
              $query_insert = "UPDATE lots SET winner_id = " . $max_bet['user_id'] . " WHERE lot_id = " . $val['lot_id'];
              $result_insert = mysqli_query($con, $query_insert);
              $message = (new Swift_Message("Ваша ставка выиграла"));
              $message->setFrom(["keks@phpdemo.ru" => "Yeticave"]);
              $message->setTo([$max_bet["email"] => "Победитель"]);
              $username = $max_bet['user_name'];
              $lot_name = $val['name'];
              $lot_id = $max_bet['lot_id'];
              $message_content = render_template('email.php', ['username' => $username, 'lot_name' => $lot_name, 'lot_id' => $lot_id]);
              //$message_content = render_template('email.php', ['username' => $max_bet['username'], 'lot_name' => $val['name'], 'lot_id' => $max_bet['lot_id']]);
              $message->setBody($message_content, 'text/html');
              $mailer = new Swift_Mailer($transport);
              $mailer->send($message);
          } else {
              $query_insert = "UPDATE lots SET winner_id = " . $val['user_id'] . " WHERE lot_id = " . $val['lot_id'];
              $result_insert = mysqli_query($con, $query_insert);
          }
      }
  }
}

?>
