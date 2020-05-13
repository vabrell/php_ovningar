<?php

require('Database.php');
$db = new Database;

$animals = $db->conn()->query("SELECT * FROM animals");

foreach($animals->fetchAll(PDO::FETCH_OBJ) as $animal) {
    echo "<p>$animal->name</p>";
}
