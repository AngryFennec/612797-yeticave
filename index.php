<?php
require_once('init.php');
$pagination = "";
$pages = [];
$cat_id = "";
$sql_cat = "";

$cur_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 9;
$offset = 0;

if (isset($_GET['category'])) {
  $cat_id = intval($_GET['category']);
  $sql_cat = "AND l.category_id = " . $cat_id;
}

$sql_pagination = "SELECT COUNT(*) AS count FROM lots WHERE end_date > NOW()" . $sql_cat;
$result_pagination = mysqli_query($con, $sql_pagination);

if ($result_pagination) {
    $lots_count = mysqli_fetch_all($result_pagination, MYSQLI_ASSOC);
    //$pages_count = ceil(($lots_count['count']) / $limit);
/*
    if ($cur_page === 0 || $cur_page > $pages_count) {
        $cur_page = 1;
    }

    $offset = ($cur_page - 1) * $limit;

    $pages = range(1, $pages_count);
    foreach ($pages as $page) {
        $pagination = render_template('pagination.php', ['page' => $page, 'cur_page' => $cur_page, 'category' => $cat_id]);
    }*/
}


$sql_lot = "SELECT lot_id, name, c.cat_name, l.category_id, sum, img, end_date FROM lots l JOIN categories c ON l.category_id = c.category_id WHERE l.end_date > NOW() " . $sql_cat . " ORDER BY l.init_date DESC LIMIT" . $limit . " OFFSET" . $offset;
$result_lot = mysqli_query($con, $sql_lot);
if ($result_lot) {
    $lots = mysqli_fetch_all($result_lot, MYSQLI_ASSOC);
}


$page_content = render_template('index.php', ['categories' => $categories, 'lots' => $lots, 'cat_id' => $cat_id, 'pages' => $pages]);
$layout_content = render_template('layout.php', ['page_content' => $page_content, 'title' => 'Главная', 'categories' => $categories,  'user' => $user]);
print($layout_content);

?>
