<?php

$random = [];

for( $i = 0; $i < 10; $i++ ) {
  array_push($random, rand(0, 999));
}

function randomNumbers(int $amount, array $rand) {
  $numbers = [];

  for( $i = 0; $i < $amount; $i++ ) {
    array_push($numbers, $rand[rand(0, count($rand) -1 )]);
  }

  return $numbers;
}

print_r(randomNumbers(3, $random));