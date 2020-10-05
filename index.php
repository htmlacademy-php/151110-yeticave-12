<?php
$is_auth = rand(0, 1);

$user_name = 'Веточка'; // укажите здесь ваше имя

$categories = [
    "Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"
];

$lots = [
    [
        'title' => '2014 Rossignol District Snowboard',
        'category' => 'Доски и лыжи',
        'price' => 10999,
        'image' => 'img/lot-1.jpg'
    ],
    [
        'title' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => 'Доски и лыжи',
        'price' => 159999,
        'image' => 'img/lot-2.jpg'
    ],
    [
        'title' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'Крепления',
        'price' => 8000,
        'image' => 'img/lot-3.jpg'
    ],
    [
        'title' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => 'Ботинки',
        'price' => 10999,
        'image' => 'img/lot-4.jpg'
    ],
    [
        'title' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => 'Одежда',
        'price' => 7500,
        'image' => 'img/lot-5.jpg'
    ],
    [
        'title' => 'Маска Oakley Canopy',
        'category' => 'Разное',
        'price' => 5400,
        'image' => 'img/lot-6.jpg'
    ]
];

function format_price ($price) {

    $price_rounded = ceil($price);
    $currency = "₽";

    if ($price_rounded < 1000) {
        $price_formatted = $price_rounded;
    } else {
        $price_formatted = number_format($price_rounded, 0, ".", " ");
    }

    return $price_formatted . " " . $currency;
}

function include_template ($path, $data) {
    extract($data);

    ob_start();
    require($path);
    $result = ob_get_contents();
    ob_end_clean();

    return $result;
}

$page_content = include_template('templates/main.php', ['categories' => $categories, 'lots' => $lots]);

$layot_content = include_template('templates/layout.php', ['page_content' => $page_content, 'page_title' => 'Главная', 'is_auth' => $is_auth, 'user_name' => $user_name, 'categories' => $categories]);

print($layot_content);
?>
