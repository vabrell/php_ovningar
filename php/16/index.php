<?php

function checkAccord(array $accord)
{
    $knownAccords = [
        'C' => ['x', 3, 2, 0, 1, 0],
        'D' => ['x', 'x', 0, 2, 3, 2],
        'Em' => [0, 2, 2, 0, 0, 0],
        'F' => ['x', 'x', 3, 2, 1, 0],
        'G' => [3, 2, 0, 0, 0, 3],
        'Am' => ['x', 0, 2, 2, 1, 0]
    ];

    $result = 'Inget kännt accord';

    foreach ($knownAccords as $accordName => $knownAccord) {
        $diff = array_diff($knownAccord, $accord);
        if (count($diff) < 1) {
            $result = $accordName;
        }
    }

    return $result;
}

echo "Accord: ", checkAccord([0, 2, 2, 0, 0, 0]);
