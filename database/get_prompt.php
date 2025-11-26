<?php
$dsn = "mysql:host=localhost;dbname=jouwDB;charset=utf8mb4";
$user = "jouwUser";
$pass = "jouwPass";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $stmt = $pdo->query("SELECT text FROM Prompts ORDER BY RAND() LIMIT 1");
    $prompt = $stmt->fetchColumn();

    echo $prompt ?: "Voeg een prompt toe SAMUEL";
} catch (PDOException $e) {
    http_response_code(500);
    echo "DB fout: " . $e->getMessage();
}