
<!-- 
// $servername  = "localhost";
// $userName = "root"; 
// $password = ""; 
// $dbName = "php-assignment"; 
// $conn;

// $conn = new mysqli($servername , $userName, $password, $dbName);
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } -->

<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create a connection
$conn = new mysqli($servername, $username, $password);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database if it doesn't exist
$dbName = "php-assignment-create-automayic";
$createDbQuery = "CREATE DATABASE IF NOT EXISTS `$dbName`";
if ($conn->query($createDbQuery) === TRUE) {
} else {
    echo "Error creating database: " . $conn->error . "\n";
}

// Switch to the newly created database
$conn->select_db($dbName);

// Create the 'users' table
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
if ($conn->query($createTableQuery) === TRUE) {
    echo "Table 'users' created successfully or already exists\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

// Close the connection
$conn->close();
?>




