<?php
// pdo.php — Connexion DB (MySQL + PDO)

define('DB_HOST', "localhost");
define('DB_NAME', "xxx");
define('DB_USER', "xxx");
define('DB_PASSWORD', "xxx");

try {
    $db = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $pdo = new PDO($db, DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur connexion DB: " . $e->getMessage());
}

