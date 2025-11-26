<?php
$dsn = "mysql:host=localhost;dbname=jouwDB;charset=utf8mb4";
$user = "jouwUser";
$pass = "jouwPass";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->exec("TRUNCATE TABLE Prompts");
    echo "Alle prompts gewist!";
} catch (PDOException $e) {
    http_response_code(500);
    echo "DB fout: " . $e->getMessage();
}
