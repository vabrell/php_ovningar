<?php

$string = 'Den första strängen';
$string1 = 'Den andra strängen';

$length = strlen($string);
$length1 = strlen($string1);

$summa = $length + $length1;
// Använd ABS för att få ett absolut tal, dvs alltid göra det positivt
$skillnad = abs($length - $length1);
$kvot = $length / $length1;
$rest = $length % $length1;

echo "Summa: $summa<br>";
echo "Skillnad: $skillnad<br>";
echo "Kvot: $kvot<br>";
echo "Rest: $rest";