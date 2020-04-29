<?php

$suits = ['HEARTS', 'DIAMONDS', 'CLUBS', 'SPADES'];
$deck = [];

foreach( $suits AS $suit ) {
  for( $i = 1; $i <= 13; $i++) {
    switch($i) {
      case 1:
        $name = 'Ace';
        $value = $i;
      break;

      case 11:
        $name = 'Jack';
        $value = 10;
      break;

      case 12:
        $name = 'Queen';
        $value = 10;
      break;

      case 13:
        $name = 'King';
        $value = 10;
      break;

      default:
        $name = $i;
        $value = $i;
    }
    array_push($deck, [
      'suit' => $suit,
      'name' => $name,
      'value' => $value
    ]);
  }
}

echo $deck[4]['name'], " of ", $deck[4]['suit'];