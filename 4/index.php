<?php

$months = [
  'Januari',
  'Februari',
  'Mars',
  'April',
  'Maj',
  'Juni',
  'Juli',
  'Augusti',
  'September',
  'Oktober',
  'November',
  'December'
];

$days = [
  'Januari' => 31,
  'Februari' => 28,
  'Mars' => 31,
  'April' => 30,
  'Maj' => 31,
  'Juni' => 30,
  'Juli' => 31,
  'Augusti' => 31,
  'September' => 30,
  'Oktober' => 31,
  'November' => 30,
  'December' => 31
];

foreach( $months AS $month ) {
  echo "$month, har $days[$month] antal dagar<br>";
}