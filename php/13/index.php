<?php

function updatePopulation(array $oldInfo, array $newInfo)
{
    foreach ($newInfo as $key => $value) {
        $oldInfo[$key] = $oldInfo[$key] + $value;
    }

    return $oldInfo;
}

$islands = [
    'Hönö' => 1504,
    'Öckerö' => 4972,
    'Björkö' => 340,
    'Grötö' => 182,
    'Kalvsund' => 31,
    'Rörö' => 59,
    'Källö-Knippla' => 16,
    'Hypplen' => 0,
    'Hälsö' => 72,
    'Fotö' => 488
];

$newIslands = array_map(function ($island) {
    $island = ($island + 1) * 2;
    return $island;
}, $islands);


$newInfo = updatePopulation($islands, $newIslands);
ksort($newInfo);

print_r($newInfo);
