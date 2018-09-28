<?php
// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];
$categories = [
[
    "name" => "Доски и лыжи",
    "class" => "boards"
],
[
    "name" => "Крепления",
    "class" => "attachment"
],
[
    "name" => "Ботинки",
    "class" => "boots"
],
[
    "name" => "Одежда",
    "class" => "clothing"
],
[
    "name" => "Инструменты",
     "class" => "tools"
 ],
 [
     "name" => "Разное",
     "class" => "other"
 ]
];
$lots = [
    [
        'name' => '2014 Rossignol District Snowboard',
        'category' => $categories[0]["name"],
        'price' => 10999,
        'url' => 'img/lot-1.jpg'
    ],
    [
        'name' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => $categories[0]["name"],
        'price' => 159999,
        'url' => 'img/lot-2.jpg'
    ],
    [
        'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => $categories[1]["name"],
        'price' => 8000,
        'url' => 'img/lot-3.jpg'
    ],
    [
        'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => $categories[2]["name"],
        'price' => 10999,
        'url' => 'img/lot-4.jpg'
    ],
    [
        'name' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => $categories[3]["name"],
        'price' => 7500,
        'url' => 'img/lot-5.jpg'
    ],
    [
        'name' => 'Маска Oakley Canopy',
        'category' => $categories[5]["name"],
        'price' => 5400,
        'url' => 'img/lot-1.jpg'
    ]
];
?>
