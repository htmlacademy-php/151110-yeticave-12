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
        'image' => 'img/lot-1.jpg',
        'expiration' => '2020-10-11'
    ],
    [
        'title' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => 'Доски и лыжи',
        'price' => 159999,
        'image' => 'img/lot-2.jpg',
        'expiration' => '2020-10-12'
    ],
    [
        'title' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'Крепления',
        'price' => 8000,
        'image' => 'img/lot-3.jpg',
        'expiration' => '2020-10-13'
    ],
    [
        'title' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => 'Ботинки',
        'price' => 10999,
        'image' => 'img/lot-4.jpg',
        'expiration' => '2020-10-31'
    ],
    [
        'title' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => 'Одежда',
        'price' => 7500,
        'image' => 'img/lot-5.jpg',
        'expiration' => '2020-11-11'
    ],
    [
        'title' => 'Маска Oakley Canopy',
        'category' => 'Разное',
        'price' => 5400,
        'image' => 'img/lot-6.jpg',
        'expiration' => '2020-10-15'
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

function get_remaining_time ($expiration_date) {
    date_default_timezone_set('Asia/Novosibirsk');

    define("SECONDS_IN_HOUR", 3600);
    define("SECONDS_IN_MINUTE", 60);

    $expiration_date_unix = strtotime($expiration_date);
    $current_time_unix = time();

    $remaining_time_unix = $expiration_date_unix - $current_time_unix;

    $remaining_hours = floor($remaining_time_unix / SECONDS_IN_HOUR);
    $remaining_minutes = floor($remaining_time_unix % SECONDS_IN_HOUR / SECONDS_IN_MINUTE);

    $remaining_hours_formatted = str_pad($remaining_hours, 2, 0, STR_PAD_LEFT);
    $remaining_minutes_formatted = str_pad($remaining_minutes, 2, 0, STR_PAD_LEFT);

    return [
        'hours' => $remaining_hours_formatted,
        'minutes' => $remaining_minutes_formatted
    ];
}

$page_content = include_template('templates/main.php', ['categories' => $categories, 'lots' => $lots]);

$layot_content = include_template('templates/layout.php', ['page_content' => $page_content, 'page_title' => 'Главная', 'is_auth' => $is_auth, 'user_name' => $user_name, 'categories' => $categories]);

print($layot_content);
?>
