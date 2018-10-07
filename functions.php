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
?>
