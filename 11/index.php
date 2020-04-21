<?php
include 'functions.php';

$companies = [
    [
        'name' => 'Korvmojjen',
        'address' => 'Snabbmatsvägen 1',
        'telephone' => '0303-123 45',
        'email' => 'info@korvmojjen.se'
    ],
    [
        'name' => 'Pizzerian',
        'address' => 'Snabbmatsvägen 2',
        'telephone' => '0303-123 67',
        'email' => 'info@pizzerian.se'
    ],
    [
        'name' => 'Thaimaten',
        'address' => 'Snabbmatsvägen 3',
        'telephone' => '0303-123 89',
        'email' => 'info@thaimaten.se'
    ]
];

echo createHTMLDocument('Snabbmatsslumparen', 'Vart skall jag äta idag?', createFooter($companies));
