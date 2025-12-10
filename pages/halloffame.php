<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// database connectie includen
include("../database/database.php");

// check of $conn bestaat en ok
if (!$conn) die("Database connectie ontbreekt.");

// Haal images op
$result = $conn->query("SELECT `path` FROM `images` ORDER BY `created_at` DESC");
if (!$result) die("Query mislukt: " . $conn->error);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hall of Fame</title>
    <link rel="stylesheet" href="css/halloffame.css">
    <link rel="icon" type="image/x-icon" href="/pages/images/favi.ico">
</head>
<body>
    <?php include("../presets/nav.php"); ?>
<h1>Hall of Fame</h1>
<div class="container">
<?php while ($row = $result->fetch_assoc()): ?>
    <div>
        <img src="../<?= htmlspecialchars($row['path']) ?>" width="200"><br>
    </div>
<?php endwhile; ?>
</div>
<?php include("../presets/footer.php"); ?>
</body>

</html>