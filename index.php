<?php
require_once('init.php');

$cat_id = "";
if (isset($_GET['category'])) {
  $cat_id = intval($_GET['category']);
  $sql_lot = "SELECT lot_id, name, c.cat_name, l.category_id, sum, img, end_date FROM lots l JOIN categories c ON l.category_id = c.category_id WHERE l.end_date > NOW() AND l.category_id = ". $cat_id . " ORDER BY l.init_date DESC LIMIT 9";
} else {
  $sql_lot = "SELECT lot_id, name, c.cat_name, l.category_id, sum, img, end_date FROM lots l JOIN categories c ON l.category_id = c.category_id WHERE l.end_date > NOW() ORDER BY l.init_date DESC LIMIT 6";
}
print($cat_id);
$result_lot = mysqli_query($con, $sql_lot);
if ($result_lot) {
    $lots = mysqli_fetch_all($result_lot, MYSQLI_ASSOC);
}

$page_content = render_template('index.php', ['categories' => $categories, 'lots' => $lots, 'cat_id' => $cat_id]);
$layout_content = render_template('layout.php', ['page_content' => $page_content, 'title' => 'Главная', 'categories' => $categories,  'user' => $user]);
print($layout_content);

?>
