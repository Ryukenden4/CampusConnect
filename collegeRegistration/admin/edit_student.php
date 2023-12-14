<?php

$username = "root";
$password = "";
$dbname = "collegeregistration";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the edit request
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $studentId = $_GET["id"];
    $field = $_GET["field"];
    $value = $_GET["value"];

    // Update the specified field for the student
    $updateSql = "UPDATE student SET $field = '$value' WHERE ID = '$studentId'";
    
    if ($conn->query($updateSql) === TRUE) {
        echo "Update successful";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Closing the database connection
$conn->close();
?>
