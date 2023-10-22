<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$dbName = "php-assignment-create-automayic";
$createDbQuery = "CREATE DATABASE IF NOT EXISTS `$dbName`";
if ($conn->query($createDbQuery) === TRUE) {
} else {
    echo "Error creating database: " . $conn->error . "\n";
}

$conn->select_db($dbName);

$createTableQuery = "CREATE TABLE IF NOT EXISTS users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  confirm_password VARCHAR(255) NOT NULL,
  gender ENUM('Male', 'Female', 'Other') NOT NULL,
  website VARCHAR(255),
  profile_picture VARCHAR(255),
  terms_accepted BOOLEAN NOT NULL
)";
if (!$conn->query($createTableQuery) === TRUE) {
    echo "Error creating table: " . $conn->error . "\n";

}

?>




