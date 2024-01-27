<?php
session_start();

// Establishing a connection to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegeregistration";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the studentID is provided via POST request
if (isset($_POST['studentID'])) {
    // Sanitize the input
    $studentID = mysqli_real_escape_string($conn, $_POST['studentID']);

    // Update the student's status to 'Disabled'
    $sql = "UPDATE student SET status = 'Disabled' WHERE studentID = '$studentID'";
    if ($conn->query($sql) === TRUE) {
        echo "Student delete successfully.";
    } else {
        echo "Error updating student status: " . $conn->error;
    }
} else {
    echo "StudentID not provided.";
}

// Closing the database connection
$conn->close();
?>
