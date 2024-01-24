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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request
    $studentId = $_POST['studentId'];
    $newStartTime = $_POST['newStartTime'];
    $newEndTime = $_POST['newEndTime'];

    // Update the booking in your database
    // Replace this with your actual update query based on your database structure
    $updateQuery = "UPDATE booking SET startTime = '$newStartTime', endTime = '$newEndTime' WHERE studentId = '$studentId'";

    // Perform the query
    // Replace $conn with your actual database connection variable
    if (mysqli_query($conn, $updateQuery)) {
        // Successful update
        http_response_code(200);
        echo "Booking updated successfully";
    } else {
        // Error in updating
        http_response_code(500);
        echo "Error updating booking: " . mysqli_error($conn);
    }
} else {
    // Invalid request method
    http_response_code(400);
    echo "Invalid request method";
}

// Closing the database connection
$conn->close();
?>
