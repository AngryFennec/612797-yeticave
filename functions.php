<?php

function render_template($name, $data) {
    $name = 'templates/' . $name;
    $result = '';

    if (!file_exists($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require($name);

    $result = ob_get_clean();

    return $result;
}

function format_sum($sum) {
    $round_sum = ceil($sum);
    $sum_string = ceil($round_sum) . "₽";
    if ($round_sum >= 1000) {
        $sum_string = number_format(ceil($sum), 0, ".", " ") . "₽";
    }
    return $sum_string;
}

function get_random_date() {
    $max_date = strtotime('2018-10-12');
    return (rand(time(), $max_date));
}

function get_formatted_time($end_date) {
    $end_date = strtotime($end_date);
    $diff_date = $end_date - time();
    $hours = floor($diff_date / 3600);
    $minutes = floor(($diff_date % 3600) / 60);
    $result = $hours.':'.$minutes;
    if ($hours >= 24) {
        $days = floor($hours / 24);
        $result = $days." дн.";
        if ($days > 7) {
            $result = date("d.m.Y", $end_date);
        }
    }
    return $result;
}

/*
function get_categories($categories, $con) {
    if ($categories == []) {
        $sql_cat = "SELECT * FROM categories";
        $result_cat = mysqli_query($con, $sql_cat);
        if ($result_cat) {
            $categories = mysqli_fetch_all($result_cat, MYSQLI_ASSOC);
        }
        else {
            $categories = [];
        }
    }
    return $categories;
}

function get_lots($lots, $con) {
    if ($lots == []) {
        $sql_lot = "SELECT name, c.cat_name, sum, img, end_date FROM lots l JOIN categories c ON l.category_id = c.category_id WHERE l.winner_id IS NULL ORDER BY l.init_date DESC LIMIT 6";
        $result_lot = mysqli_query($con, $sql_lot);
        if ($result_lot) {
            $lots = mysqli_fetch_all($result_lot, MYSQLI_ASSOC);
        }
        else {
            $lots = [];
        }
    }
    return $lots;
}
*/
?>
