<?php

// Database connection details
$servername = "localhost"; // Hostname
$username = "root"; // MySQL username
$password = ""; // MySQL password
$database = "testdb"; // Database name
$port = 3306; // MySQL port

// Create connection
$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to create the Members table
$sql = "CREATE TABLE IF NOT EXISTS Members1 (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    CreatedDate DATETIME,
    Name VARCHAR(50),
    ParentId INT,
    FOREIGN KEY (ParentId) REFERENCES Members(Id)
) ENGINE=InnoDB";

// Execute query
if ($conn->query($sql) === TRUE) {
    echo "Table Members created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close connection
$conn->close();

?>
