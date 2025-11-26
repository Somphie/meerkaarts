<?php

include("prompts_database.php");

$sql = "SELECT prompt_text FROM prompts ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    header('Content-Type: application/json');
    echo json_encode($row);
} else {
    header('Content-Type: application/json');
    echo json_encode(['prompt_text' => '']);
}