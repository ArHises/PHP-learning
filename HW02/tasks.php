<?php
declare(strict_types=1);

//  Task 01: 
function calculate(int $a, int $b, string $op): int {
    if ($op === '+') {
        return $a + $b;
    } elseif ($op === '-') {
        return $a - $b;
    } elseif ($op === '*') {
        return $a * $b;
    } elseif ($op === '/') {
        if ($b === 0) {
            throw new Exception('Division by zero is not allowed');
        }
        return intdiv($a, $b);
    } else {
        throw new Exception('Invalid operator');
    }
}

$a = 5;
$b = 3;

if(false){ // to test switch to true
    try {
        echo calculate($a, $b, '+') . PHP_EOL;
        echo calculate($a, $b, '-') . PHP_EOL;
        echo calculate($a, $b, '*') . PHP_EOL;
        echo calculate($a, $b, '/') . PHP_EOL;
        echo calculate($a, 0, '/') . PHP_EOL; // division by zero
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage() . PHP_EOL;
    }

    try {
        echo calculate($a, $b, 'invalid_operator') . PHP_EOL; // invalid operator
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage() . PHP_EOL;
    }
}
//  Task 02:

function mathOperation($arg1, $arg2, $operation):int {
    switch ($operation) {
        case '+':
            return $arg1 + $arg2;
        case '-':
            return $arg1 - $arg2;
        case '*':
            return $arg1 * $arg2;
        case '/':
            if ($arg2 == 0) {
                throw new Exception('Division by zero is not allowed');
            }
            return $arg1 / $arg2;
        default:
            throw new Exception('Invalid operation');
    }
}

// Task 03:

$regions = [
    'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
    'Рязанская область' => ['Рязань', 'Касимов', 'Скопин'],
    'Новосибирская область' => ['Новосибирск', 'Бердск', 'Искитим'],
    'Свердловская область' => ['Екатеринбург', 'Нижний Тагил', 'Каменск-Уральский'],
    'Краснодарский край' => ['Краснодар', 'Сочи', 'Новороссийск'],
];

if (false) { // to test switch to true
    foreach ($regions as $region => $cities) {
        echo $region . ': ' . implode(', ', $cities) . PHP_EOL;
    }
}

// Task 04:

function transliterate($string) {

    $translitMap = [
        'а' => 'a',  'б' => 'b',  'в' => 'v',  'г' => 'g',  'д' => 'd',
        'е' => 'e',  'ё' => 'yo', 'ж' => 'zh', 'з' => 'z',  'и' => 'i',
        'й' => 'y',  'к' => 'k',  'л' => 'l',  'м' => 'm',  'н' => 'n',
        'о' => 'o',  'п' => 'p',  'р' => 'r',  'с' => 's',  'т' => 't',
        'у' => 'u',  'ф' => 'f',  'х' => 'kh', 'ц' => 'ts', 'ч' => 'ch',
        'ш' => 'sh', 'щ' => 'shch', 'ъ' => '', 'ы' => 'y',  'ь' => '',
        'э' => 'e',  'ю' => 'yu', 'я' => 'ya'];

        return strtr($string, $translitMap);
}

if(false){ // to test switch to true
    $text = "привет, мир!";
    echo transliterate($text);
}

// Task 05:

function power($val, $pow) {
    // любая степень 0 равна 1
    if ($pow === 0) {
        return 1;
    }

    return $val * power($val, $pow - 1);
}

if(false){ // to test switch to true
    echo power(2, 3) . PHP_EOL;  // 8 (2^3)
    echo power(5, 0) . PHP_EOL;  // 1 (5^0)
}

// Task 06:

function getDeclension($number, $one, $two, $five) {
    $n = abs($number) % 100;
    $n1 = $n % 10;
    if ($n > 10 && $n < 20) {
        return $five;
    }
    if ($n1 > 1 && $n1 < 5) {
        return $two;
    }
    if ($n1 == 1) {
        return $one;
    }
    return $five;
}

function currentTime() {
    $hours = (int)date('H');
    $minutes = (int)date('i');

    $hourDeclension = getDeclension($hours, 'час', 'часа', 'часов');
    $minuteDeclension = getDeclension($minutes, 'минута', 'минуты', 'минут');

    return "$hours $hourDeclension $minutes $minuteDeclension";
}

echo currentTime();
