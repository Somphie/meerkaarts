<?php

include("database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['value'])) {
    $value = $_POST['value'];

    $stmt = $conn->prepare("INSERT INTO prompts (prompt_text) VALUES (?)");
    $stmt->bind_param("s", $value);
    $stmt->execute();
    $stmt->close();
    echo "Success: data saved!";
} else {
    echo "Error: value missing";
}