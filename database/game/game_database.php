<?php
$servername = "database-5019130626.webspace-host.com";
$username = "dbu1215089";
$password = "wearecharliekirkwecarrytheflame1234567891011121314151617181921!";
$dbname = "dbs15034918";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}