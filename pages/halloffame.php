<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// database connectie includen
include("../database/database.php");

// check of $conn bestaat en ok
if (!$conn) die("Database connectie ontbreekt.");

// Haal images op
$result = $conn->query("SELECT filename FROM images ORDER BY uploaded_at DESC");
if (!$result) die("Query mislukt: " . $conn->error);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hall of Fame</title>
</head>
<body>
<h1>Hall of Fame</h1>
<div style="display:flex; flex-wrap:wrap; gap:10px;">
<?php while ($row = $result->fetch_assoc()): ?>
    <div>
        <img src="savedimg/<?= htmlspecialchars($row['filename']) ?>" width="200"><br>
        <?= htmlspecialchars($row['filename']) ?>
    </div>
<?php endwhile; ?>
</div>
</body>
</html>