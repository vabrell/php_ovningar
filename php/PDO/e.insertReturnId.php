<?php

require('Database.php');
$db = new Database;

$db->conn()->query("INSERT INTO animals (name, specimens, category_id, area_id) VALUES ('Ko', 14, 1, 1)");

echo $db->conn()->lastInsertId();