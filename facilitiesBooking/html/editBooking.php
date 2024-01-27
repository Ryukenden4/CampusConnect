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

    // Fetch the booking details from the database
    $selectQuery = "SELECT * FROM booking WHERE studentId = '$studentId'";
    $result = mysqli_query($conn, $selectQuery);

    if ($result) {
        // Check if the booking exists
        if (mysqli_num_rows($result) > 0) {
            // Fetch booking details
            $booking = mysqli_fetch_assoc($result);
        } else {
            // Booking not found
            echo "Booking not found.";
            exit;
        }
    } else {
        // Error in fetching data
        echo "Error fetching booking details: " . mysqli_error($conn);
        exit;
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission to update endTime
    $studentId = $_POST['studentId'];
    $newEndTime = $_POST['endTime'];

    // Build UPDATE query to update endTime
    $updateQuery = "UPDATE booking SET endTime = '$newEndTime' WHERE studentId = '$studentId'";

    // Perform the query
    if (mysqli_query($conn, $updateQuery)) {
        // Successful update
        echo "EndTime updated successfully!";
    } else {
        // Error in update
        echo "Error updating endTime: " . mysqli_error($conn);
    }
} else {
    // Invalid request method
    http_response_code(400);
    echo "Invalid request method";
}

// Closing the database connection
$conn->close();
?>
