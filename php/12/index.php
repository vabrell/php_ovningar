<?php

function generateNumbers(int $amount)
{
    $numbers = [];

    for ($i = 0; $i < $amount; $i++) {
        array_push($numbers, rand(1, 9));
    }

    return implode($numbers);
}

function buyTickets(int $amount)
{
    $tickets = [];

    for ($i = 0; $i < $amount; $i++) {
        array_push($tickets, generateNumbers(8));
    }

    return $tickets;
}

function checkNumbers(String $winNumbers, String $ticket)
{
    $correctNumbers = 0;

    for ($i = 0; $i < 8; $i++) {
        if ($winNumbers[$i] === $ticket[$i]) {
            $correctNumbers++;
        }
    }

    return $correctNumbers;
}

function price(String $totalNumbers)
{
    switch ($totalNumbers) {
        case 3:
            $price = '10 kr';
        break;

        case 4:
            $price = '100 kr';
        break;

        case 5:
            $price = '1000 kr';
        break;

        case 6:
            $price = '10 000 kr';
        break;

        case 7:
            $price = '100 000 kr';
        break;

        case 8:
            $price = '1 000 000 kr';
        break;

        default:
            $price = 'Ingen vinst';
    }

    return $price;
}

$winning_numbers = generateNumbers(8);
$tickets = buyTickets(10);

echo "<p><strong>Vinnande nummer:</strong> ", $winning_numbers, "</p>";

foreach ($tickets as $idx => $ticket) {
    $correctNumbers = checkNumbers($winning_numbers, $ticket);

    echo "<p><strong>Lott</strong> ",
            $idx+1,
            ": ",
            $ticket,
            "<br>Antal rätt: ",
            $correctNumbers,
            "<br>Pris: ",
            price($correctNumbers),
            "</p>";
}
