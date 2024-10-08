<?php
$a = 5;
$b = '05';
var_dump($a == $b);
var_dump((int)'012345');
var_dump((float)123.0 === (int)123.0);
var_dump(0 == 'hello, world');

// v8.2
// bool(true)
// int(12345)
// bool(false)
// bool(false)

// var_dump($a == $b);
// Вывод: bool(true)
// Объяснение: PHP выполняет нестрогое сравнение (==), приводя строки к числам. '05' приводится к числу 5.

// var_dump((int)'012345');
// Вывод: int(12345)
// Объяснение: При приведении строки '012345' к числу ноль игнорируется.

// var_dump((float)123.0 === (int)123.0);
// Вывод: bool(false)
// Объяснение: Операция === сравнивает и значение, и тип. float(123.0) и int(123) имеют разные типы.

// var_dump(0 == 'hello, world');
// Вывод: bool(true)
// Объяснение: В нестрогом сравнении строка приводится к числу. Так как строка не содержит чисел, она приводится к 0, что делает выражение 0 == 0 истинным.


// v7.4
// bool(true)
// int(12345)
// bool(false)
// bool(true)


$a = 1;
$b = 2;

$a = $a + $b; 
$b = $a - $b; 
$a = $a - $b; 

echo "a = $a, b = $b";
