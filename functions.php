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

function get_formatted_time_bet($end_date) {
    $end_date = strtotime($end_date);
    $diff_date = time() - $end_date;
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

function get_bets($lot, $con) {
    $query = "SELECT b.init_date, b.user_id, b.sum, u.name FROM bets b JOIN users u ON b.user_id = u.user_id WHERE b.lot_id = '" . $lot['lot_id'] . "' ORDER BY init_date DESC LIMIT 10";
    $result = mysqli_query($con, $query);
    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    return [];
}
function get_max_bet($bets) {
    $max = 0;
    foreach($bets as  $val){
            if ($val['sum'] > $max) {
                $max = $val['sum'];
            }
        }
    return $max;
}
function is_already_bet($user, $bets) {
    foreach($bets as  $val){
            if ($val['user_id'] == $user['user_id']) {
                return true;
            }
        }
    return false;
}
?>
