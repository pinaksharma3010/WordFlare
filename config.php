<?php
// config.php

$host = 'localhost'; // Usually localhost for local dev
$db   = 'blog';      // Your database name
$user = 'root';      // Your MySQL username
$pass = '';          // Your MySQL password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // show errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('Database Connection Failed: ' . $e->getMessage());
}
?>
