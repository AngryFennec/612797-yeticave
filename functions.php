<?php

/**
 * Формирует разметку страницы на основе шаблона и данных
 *
 * @param $name string название файла с шаблоном
 * @param array $data array данные для вставки в шаблон
 *
 * @return string Шаблон страницы с внесенными данными
 */
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


/**
 * Форматирует значение цены лота
 *
 * @param $sum int цена лота
 *
 * @return string Форматированная цена
 */
function format_sum($sum) {
    $round_sum = ceil($sum);
    $sum_string = ceil($round_sum) . "₽";
    if ($round_sum >= 1000) {
        $sum_string = number_format(ceil($sum), 0, ".", " ") . "₽";
    }
    return $sum_string;
}

/**
 * Возвращает отпечаток случайной даты в промежутке между текущей и 12.10.2018
 *
 * @return int отпечаток случайной даты в указанном диапазоне
 */
function get_random_date() {
    $max_date = strtotime('2018-10-12');
    return (rand(time(), $max_date));
}


/**
 * Формирует строку для показа времени, прошедшего с момента создания ставки
 *
 * @param $init_date string дата создания ставки
 *
 * @return string Время с момента создания ставки
 */
function get_formatted_time_bet($init_date) {
    $end_date = strtotime($init_date);
    $diff_date = time() - $init_date;
    $hours = floor($diff_date / 3600);
    $minutes = floor(($diff_date % 3600) / 60);
    $result = $hours.':'.$minutes;
    if ($hours >= 24) {
        $days = floor($hours / 24);
        $result = $days." дн.";
        if ($days > 7) {
            $result = date("d.m.Y", $diff_date);
        }
    }
    return $result;
}

/**
 * Формирует строку для показа времени, оставшегося до завершения лота
 *
 * @param $end_date string дата окончания лота
 *
 * @return string Время до завершения лота
 */
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


/**
 * Возвращает массив ставок для текущего лота
 *
 * @param array $lot array лот
 * @param mysqli $con mysqli подключение к базе
 *
 * @return array массив ставок на указанный лот
 */
function get_bets($lot, $con) {
    $query = "SELECT b.init_date, b.user_id, b.sum, u.name FROM bets b JOIN users u ON b.user_id = u.user_id WHERE b.lot_id = '" . $lot['lot_id'] . "' ORDER BY init_date DESC LIMIT 10";
    $result = mysqli_query($con, $query);
    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    return [];
}

/**
 * Возвращает максимальную ставку на лот (при наличии) или исходную цену лота
 *
 * @param array $bets array массив ставок
 * @param array $lot array лот
 *
 * @return array максимальная ставка или цена лота
 */
function get_max_bet($bets, $lot) {
    $max = $lot['sum'];
    if (!empty($bets)) {
      foreach($bets as  $val){
        if ($val['sum'] > $max) {
          $max = $val['sum'];
        }
      }
    }
    return $max;
}

/**
 * Определяет, делал ли указанный пользователь ставку на лот
 *
 * @param array $bets array массив ставок на лот
 * @param array $user array массив данных о пользователе
 *
 * @return bool флаг наличия ставки от пользователя на лот
 */
function is_already_bet($user, $bets) {
    foreach($bets as  $val){
            if ($val['user_id'] === $user['user_id']) {
                return true;
            }
        }
    return false;
}
?>
