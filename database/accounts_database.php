<?php
$servername = "database-5019078578.webspace-host.com";
$username = "dbu2537335";
$password = "desamballen2027RAHHHH";
$dbname = "dbs15004610";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}