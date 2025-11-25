<?php
$servername = "database-5019078582.webspace-host.com";
$username = "dbu1169293";
$password = "desamballen2026RAHHHH";
$dbname = "dbs15004618";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}