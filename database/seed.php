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

    // Load and run seeder
    require_once __DIR__ . '/seeds/DatabaseSeeder.php';
    $seeder = new DatabaseSeeder($pdo);
    $seeder->run();
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
