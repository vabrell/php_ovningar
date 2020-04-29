<?php

function isFemale(String $character)
{
    $females = ['a', 'e', 'i', 'o', 'u', 'y', 'å', 'ä', 'ö'];
    return in_array($character, $females);
}

function countAnimalPairs(array $animals)
{
    $checkedAnimals = [];

    foreach ($animals as $animal) {
        $count = strlen($animal);
        $females = 0;
        $males = 0;
        
        foreach (str_split($animal) as $character) {
            if (isFemale($character)) {
                $females++;
            } else {
                $males++;
            }
        }

        $leftover = abs($females - $males);
        $pairs = (($females + $males) - $leftover) / 2;

        $checkedAnimals[$animal] = [
            'pairs' => $pairs,
            'leftover' => $leftover
        ];
    }

    return $checkedAnimals;
}

$animals=[
    'skallerorm',
    'sköldpadda',
    'krabba',
    'krokodil',
    'abborre',
    'elefant',
    'katt',
    'hjort',
    'hare',
    'bi',
    'ara',
    'ål',
    'vessla',
    'nektergal',
    'blåval',
    'antilop',
    'grävling',
    'mullvad',
    'ozelot',
    'jaguar'
];

$optimization = countAnimalPairs($animals);
$pairs = array_column($optimization, 'pairs');
$leftover = array_column($optimization, 'leftover');
array_multisort($pairs, SORT_DESC, $leftover, SORT_ASC, $optimization);

echo "<h1>De bästa djuren att ta med</h1>";

foreach ($optimization as $animal => $values) {
    echo "<p><strong>",
            $animal,
            "</strong><br>Par: ",
            $values['pairs'],
            "<br>Överblivna: ",
            $values['leftover'],
            "</p>";
}
