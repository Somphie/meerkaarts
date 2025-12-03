<?php

include("database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "DELETE FROM prompts";
    if ($conn->query($sql) === TRUE) {
        echo "All prompts cleared successfully.";
    } else {
        echo "Error clearing prompts: " . $conn->error;
    }
} else {
    echo "Invalid request method.";
}