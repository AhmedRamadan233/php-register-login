<?php

$servername  = "localhost";
$userName = "root"; 
$password = ""; 
$dbName = "php-assignment"; 
$conn;

$conn = new mysqli($servername , $userName, $password, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>



