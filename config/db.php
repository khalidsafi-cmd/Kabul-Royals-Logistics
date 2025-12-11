<?php
// Detect environment: local or online
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    // Local XAMPP
    $host = '127.0.0.1';
    $db   = 'kabul_royals_logistics';
    $user = 'root';
    $pass = '';
} else {
    // InfinityFree hosting
    $host = 'sql210.infinityfree.com';
    $db   = 'if0_40377843_kabul_royals_logistics';
    $user = 'if0_40377843';
    $pass = 'KabulRoyals123';
}

$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
