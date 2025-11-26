<?php

include("prompts_database.php");

$sql = "SELECT id, prompt_text FROM prompts ORDER BY id DESC";
$result = $conn->query($sql);

$prompts = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $prompts[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($prompts);