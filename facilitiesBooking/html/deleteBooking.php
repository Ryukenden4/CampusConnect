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

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get studentId from the GET request
    $studentId = $_GET['studentId'];

    // Delete the booking from your database
    // Replace this with your actual delete query based on your database structure
    $deleteQuery = "DELETE FROM booking WHERE studentId = '$studentId'";

    // Perform the query
    // Replace $conn with your actual database connection variable
    if (mysqli_query($conn, $deleteQuery)) {
        // Successful deletion
        echo "Booking deleted successfully!";
    } else {
        // Error in deletion
        echo "Error deleting booking: " . mysqli_error($conn);
    }
} else {
    // Invalid request method
    http_response_code(400);
    echo "Invalid request method";
}

// Closing the database connection
$conn->close();
?>
