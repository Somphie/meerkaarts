<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "mydb";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connectie mislukt: " . $conn->connect_error);

// Haal alle images op
$result = $conn->query("SELECT filename FROM images ORDER BY uploaded_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include("../presets/nav.php"); ?>
    <div style="display:flex; flex-wrap:wrap; gap:10px;">
    <?php foreach($files as $file): ?>
        <div>
            <img src="<?= $file ?>" width="200"><br>
            <?= basename($file) ?>
        </div>
    <?php endforeach; ?>
</body>
</html>