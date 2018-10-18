require_once('init.php');
$query = "SELECT lot_id, user_id, name, sum, img, bet_step, end_date,  description, cat_name  FROM lots l JOIN categories c ON l.category_id = c.category_id WHERE MATCH (l.name, l.description) AGAINST(?)";
