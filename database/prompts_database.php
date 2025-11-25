<?php
$servername = "database-5019078569.webspace-host.com";
$username = "dbu1219007";
$password = "desamballen2025RAHHHH";
$dbname = "dbs15004602";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}