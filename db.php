<?php
$db = new PDO('pgsql:host=127.0.0.1;dbname=ums', 'postgres', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
]);
$statement = $db->query("SELECT * FROM roles");
$result = $statement->fetchAll();
print_r($result);
