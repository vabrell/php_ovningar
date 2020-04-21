<?php

function translator(String $unit, Int $value)
{
    $kvadratmeter = 1;
    $fotbollsplan = 105 * 65;
    $hektar = 100 * 100;
    $kvadratkilometer = 1000 * 1000;

    switch ($unit) {
        case 'kvadratmeter':
            $translation = [
                'kvadratkilometer' => $value / $kvadratkilometer,
                'hektar' => ($value * $kvadratmeter) / $hektar,
                'fotbollsplan' => ($value * $kvadratmeter) / $fotbollsplan
            ];
        break;

        case 'hektar':
            $translation = [
                'kvadratkilometer' => ($value * $hektar) / $kvadratkilometer,
                'kvadratmeter' => $value * $hektar,
                'fotbollsplan' => ($value * $hektar) / $fotbollsplan
            ];
        break;

        case 'fotbollsplan':
            $translation = [
                'kvadratkilometer' => ($value * $fotbollsplan) / $kvadratkilometer,
                'kvadratmeter' => $value * $fotbollsplan,
                'hektar' => ($value * $fotbollsplan) / $hektar
            ];
        break;

        case 'kvadratkilometer':
            $translation = [
                'kvadratmeter' => $value * $kvadratkilometer,
                'hektar' => ($value * $kvadratkilometer) / $hektar,
                'fotbollsplan' => ($value * $kvadratkilometer) / $fotbollsplan
            ];
        break;

    }

    return $translation;
}

echo "<strong>1 Kvadratkilometer</strong>";
foreach (translator('kvadratkilometer', 1) as $key => $value) {
    echo "<br>", ucfirst($key), ": ", $value;
}

echo "<br><br><strong>1 Hektar</strong>";
foreach (translator('hektar', 1) as $key => $value) {
    echo "<br>", ucfirst($key), ": ", $value;
}

echo "<br><br><strong>1 Fotbollsplan</strong>";
foreach (translator('fotbollsplan', 1) as $key => $value) {
    echo "<br>", ucfirst($key), ": ", $value;
}

echo "<br><br><strong>1 Kvadratmeter</strong>";
foreach (translator('kvadratmeter', 1) as $key => $value) {
    echo "<br>", ucfirst($key), ": ", $value;
}
