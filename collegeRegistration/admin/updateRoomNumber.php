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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = $_POST['id'];
    $newRoomNumber = $_POST['newRoomNumber'];

    // Update the room number in the database
    $updateQuery = "UPDATE room SET roomNumber = ? WHERE studentID = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ss", $newRoomNumber, $studentID);

    if ($stmt->execute()) {
        echo 'Room number updated successfully!';
    } else {
        echo 'Error updating room number: ' . $conn->error;
    }

    $stmt->close();
}

// Closing the database connection
$conn->close();
?>
