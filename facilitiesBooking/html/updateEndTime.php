<?php
// Establishing a connection to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegeregistration";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the POST request
$studentId = $_POST['studentId'];
$newEndTime = $_POST['endTime'];

// Update the endTime in the database
$query = "UPDATE booking SET endTime = '$newEndTime' WHERE studentId = '$studentId'";
$result = mysqli_query($conn, $query);

// Check if the update was successful
if ($result) {
    echo "EndTime updated successfully";
} else {
    echo "Error updating endTime: " . mysqli_error($conn);
}

// Closing the database connection
$conn->close();
?>
