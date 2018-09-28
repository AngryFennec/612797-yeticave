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

function get_formatted_time() {
    $ts_midnight = strtotime('tomorrow');
    $secs_to_midnight = $ts_midnight - time();
    $hours = floor($secs_to_midnight / 3600);
    $minutes = floor(($secs_to_midnight % 3600) / 60);
    return $hours.':'.$minutes;
}
?>
