<?php
require_once('init.php');
$search = trim($_GET['search']);
$lots_searched = [];
$cur_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 9;
$offset = 0;

if (empty($search)) {

} else {
 $query = "SELECT lot_id, user_id, name, sum, img, bet_step, end_date,  description, cat_name  FROM lots l JOIN categories c ON l.category_id = c.category_id WHERE MATCH (l.name, l.description) AGAINST(?)";
 $stmt = mysqli_prepare($con, $query);
 mysqli_stmt_error($stmt);
 mysqli_stmt_bind_param($stmt, 's', $search);
 mysqli_stmt_execute($stmt);
 $result = mysqli_stmt_get_result($stmt);
 if (!empty($result)) {
     $lots_searched = mysqli_fetch_all($result, MYSQLI_ASSOC);
     $pages_count = ceil(mysqli_num_rows($result) / $limit);

     if ($cur_page === 0 || $cur_page > $pages_count) {
         $cur_page = 1;
     }

     $offset = ($cur_page - 1) * $limit;

     $pages = range(1, $pages_count);
     $pagination = render_template('pagination.php', ['pages_count' => $pages_count, 'cur_page' => $cur_page, 'pages' => $pages]);
     }
 }

$page_content = render_template('search.php', ['categories' => $categories, 'search' => $search, 'pagination' => $pagination, 'lots_searched' => $lots_searched]);
$layout_content = render_template('layout.php', ['page_content' => $page_content, 'title' => 'Главная', 'categories' => $categories, 'user' => $user]);
print($layout_content);
?>
