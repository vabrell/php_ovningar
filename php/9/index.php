<?php

function sum()
{
  $arguments = func_get_args();
  $total = count($arguments);

  if ($total < 1) return;

  $sum = 0;

  foreach ($arguments as $arg) {
    $sum += $arg;
  }

  sort($arguments);

  if ($total % 2 == 1) {
    $median = floor($total / 2);
  } else {
    $median = ($arguments[($total / 2) - 1] + $arguments[$total / 2]) / 2;
  }

  return [
    $sum,
    $median
  ];
}

[$sum, $median] = sum(-13, -22, -12, -134);
echo "Summa: $sum<br>";
echo "Median: $median";
