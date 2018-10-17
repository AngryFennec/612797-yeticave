<?php
require_once('init.php');

$cat_id = "";
$sql_cat = "";
if (isset($_GET['category'])) {
  $cat_id = intval($_GET['category']);
  $sql_cat = "AND l.category_id = " . $cat_id;
}
$sql_lot = "SELECT lot_id, name, c.cat_name, l.category_id, sum, img, end_date FROM lots l JOIN categories c ON l.category_id = c.category_id WHERE l.end_date > NOW() " . $sql_cat . " ORDER BY l.init_date DESC LIMIT 9";
$result_lot = mysqli_query($con, $sql_lot);
if ($result_lot) {
    $lots = mysqli_fetch_all($result_lot, MYSQLI_ASSOC);
}

$page_content = render_template('index.php', ['categories' => $categories, 'lots' => $lots, 'cat_id' => $cat_id]);
$layout_content = render_template('layout.php', ['page_content' => $page_content, 'title' => 'Главная', 'categories' => $categories,  'user' => $user]);
print($layout_content);

?>
