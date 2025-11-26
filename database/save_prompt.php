<?php
$dsn = "mysql:host=localhost;dbname=jouwDB;charset=utf8mb4";
$user = "jouwUser";
$pass = "jouwPass";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prompt = trim($_POST['prompt'] ?? '');
    if ($prompt === '') {
        http_response_code(400);
        echo "Lege prompt";
        exit;
    }

    try {
        $pdo = new PDO($dsn, $user, $pass);
        $stmt = $pdo->prepare("INSERT INTO Prompts (text) VALUES (:text)");
        $stmt->execute(['text' => $prompt]);
        echo "Prompt opgeslagen!";
    } catch (PDOException $e) {
        http_response_code(500);
        echo "DB fout: " . $e->getMessage();
    }
}
