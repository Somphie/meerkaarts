<?php

header('Content-Type: application/json');
include 'database.php';

$request = json_decode(file_get_contents("php://input"), true);

if (!isset($request['image']) || !isset($request['filename'])) {
    echo json_encode(['status' => 'error', 'error' => 'Geen afbeelding of bestandsnaam meegegeven']);
    exit;
}

$imageData = str_replace('data:image/png;base64,', '', $request['image']); 
$imageData = str_replace(' ', '+', $imageData);
$decodedImage = base64_decode($imageData);

if ($decodedImage === false) {
    echo json_encode(['status' => 'error', 'error' => 'Base64 decode mislukt']);
    exit;
}

$uploadFolder = __DIR__ . '/images/';
if (!file_exists($uploadFolder)) {
    mkdir($uploadFolder, 0777, true);
}

$tempPath = 'database/images/temp.png';
$stmt = $conn->prepare("INSERT INTO images (path, created_at) VALUES (?, NOW())");
$stmt->bind_param("s", $tempPath);
$stmt->execute();
$imageId = $conn->insert_id;
$stmt->close();

$originalFilename = preg_replace('/[^a-z0-9_]/i', '_', $request['filename']);

$filename = $imageId . '_' . $originalFilename . '.png';
$fullPath = $uploadFolder . $filename;

if (!file_put_contents($fullPath, $decodedImage)) {
    $conn->query("DELETE FROM images WHERE id = $imageId");
    echo json_encode(['status' => 'error', 'error' => 'Opslaan bestand mislukt']);
    exit;
}

$dbPath = 'database/images/' . $filename;
$stmt = $conn->prepare("UPDATE images SET path = ? WHERE id = ?");
$stmt->bind_param("si", $dbPath, $imageId);
$stmt->execute();
$stmt->close();
$conn->close();

echo json_encode([
    'status' => 'success',
    'id' => $imageId,
    'path' => $dbPath
]);
