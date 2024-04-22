<?php
// Check if the form data is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $parent = $_POST['parent'];
    $name = $_POST['name'];

    // Validate form data (optional)
    // You can add additional validation logic here if needed

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "testdb";
    $port = 3306;

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database, $port);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO members1 (ParentId, Name) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $parent, $name);

    // Execute SQL statement
    if ($stmt->execute()) {
        // Data inserted successfully
        echo "Data saved successfully!";
    } else {
        // Error occurred while inserting data
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If the form data is not submitted via POST method, return an error message
    echo "Error: Form data not submitted!";
}
?>
