<?php

/**
 * Create a HTML document
 *
 * @param {String} $title The title of the HTML document
 * @param {String} $heading The heading of the HTML document
 * @param {String} $footer The footer of the HTML document
 *
 * @return {String} $html The HTML document
 */
function createHTMLDocument(String $title, String $heading, String $footer)
{
    $html = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$title</title>
</head>
<body>
    <h1>$heading</h1>
    $footer    
</body>
</html>
HTML;

    return $html;
}

/**
 * Create a HTML footer with information about a random company
 *
 * @param {Array} $companies Must include name, address, telephone and email
 *
 * @return {String} $footer A HTML footer
 */
function createFooter(array $companies)
{
    $values = $companies[ rand(0, count($companies) - 1) ];
    $name = $values['name'];
    $address = $values['address'];
    $telephone = $values['telephone'];
    $email = $values['email'];

    $footer = <<<HTML
<footer>
    <h2>$name</h2>
    <p><strong>Adress:</strong> $address</p>
    <p><strong>Telefon:</strong> $telephone</p>
    <p><strong>E-post:</strong> $email</p>
</footer>
HTML;

    return $footer;
}
