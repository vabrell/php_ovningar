<?php

require('Database.php');
$db = new Database;

$animal_id1 = 1;
$animal_id2 = 2;

$sql = "SELECT * FROM animals WHERE id = :id1 OR id = :id2 ";

$stmt = $db->conn()->prepare($sql);

$stmt->execute([
    ":id1" => $animal_id1,
    ":id2" => $animal_id2
]);

foreach ($stmt->fetchAll(PDO::FETCH_OBJ) as $animal) {
    echo "<p>$animal->name</p>";
}