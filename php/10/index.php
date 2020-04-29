<?php

$ticket = [];

for ($i = 0; $i < 7; $i++) {
  do {
    $number = rand(1, 35);
  } while(in_array($number, $ticket));

  array_push($ticket, $number);
}

var_dump($ticket);