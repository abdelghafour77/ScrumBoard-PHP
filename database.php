<?php

//CONNECT TO MYSQL DATABASE USING MYSQLI
$servername = "localhost";
$db = "youcodescrumboard";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $conn->connect_error;
    exit();
}
