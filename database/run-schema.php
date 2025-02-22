<?php

require_once __DIR__ . '/../config.php';

try {
    // Create PDO connection
    $config = require __DIR__ . '/../config.php';
    $dbConfig = $config['database'];

    $dsn = "mysql:host={$dbConfig['host']};port={$dbConfig['port']};dbname={$dbConfig['dbname']};charset={$dbConfig['charset']}";
    $pdo = new PDO($dsn, 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    // Read the SQL file
    $sql = file_get_contents(__DIR__ . '/mysql-schema.sql');

    // Execute the SQL commands
    $pdo->exec($sql);

    echo "Schema executed successfully!\n";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
} catch (Exception $e) {
    die("Error executing schema: " . $e->getMessage());
}
