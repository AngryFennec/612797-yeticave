<?php
require_once('init.php');
$search = trim($_GET['search']);
$lots_searched = [];
$pagination = "";
$pages = [];
$cat_id = "";
$sql_cat = "";
$sql_cat_for_pagination = "";

$cur_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 9;
$offset = 0;
$error = '';

if (empty($search)) {
    $error = 'Пустой запрос';
} else {
 $query = "SELECT lot_id, l.init_date, user_id, name, sum, img, bet_step, end_date,  description, cat_name  FROM lots l JOIN categories c ON l.category_id = c.category_id WHERE MATCH (l.name, l.description) AGAINST(?) ORDER BY l.init_date DESC";
 $stmt = mysqli_prepare($con, $query);
 mysqli_stmt_error($stmt);
 mysqli_stmt_bind_param($stmt, 's', $search);
 mysqli_stmt_execute($stmt);
 $result = mysqli_stmt_get_result($stmt);
 if (!empty($result)) {
     $lots_searched = mysqli_fetch_all($result, MYSQLI_ASSOC);
     $lots_count = count($lots_searched);
     $pages_count = intval(ceil($lots_count / $limit));


     if ($cur_page < 1) {
         $cur_page = 1;
     }
     elseif($cur_page > $pages_count) {
         $cur_page = $pages_count;
     }

     $offset = ($cur_page - 1) * $limit;
     if ($lots_count !== 1) {
         $lots_searched = array_slice($lots_searched, $offset, $offset + $limit);
     }
     $pages = range(1, $pages_count);
     $pagination = render_template('pagination.php', ['pages_count' => $pages_count, 'cur_page' => $cur_page, 'pages' => $pages, 'page_name' => 'search.php', 'search' => $search]);
 }
}


$page_content = render_template('search.php', ['categories' => $categories, 'search' => $search, 'pagination' => $pagination, 'lots_searched' => $lots_searched, 'error' => $error]);
$layout_content = render_template('layout.php', ['page_content' => $page_content, 'title' => 'Главная', 'categories' => $categories, 'user' => $user]);
print($layout_content);
?>
