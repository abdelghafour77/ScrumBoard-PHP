<?php

//CONNECT TO MYSQL DATABASE USING MYSQLI
$servername = "localhost";
$db = "youcodescrumboard";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $db);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
