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
    // Check if 'responseID' exists in the $_GET array
    if (isset($_GET['responseID'])) {
        // Get responseID from the GET request
        $responseID = $_GET['responseID'];

        // Performing SQL query to update status to 'disabled'
        $updateQuery = "UPDATE response SET status = 'DISABLE' WHERE responseID = $responseID";

        if (mysqli_query($conn, $updateQuery)) {
            // Successful update in the database
            echo "Response disabled successfully!";
        } else {
            // Error in update
            echo "Error disabling response: " . mysqli_error($conn);
        }
    } else {
        // 'responseID' is not provided in the URL
        http_response_code(400);
        echo "Invalid request: 'responseID' parameter is missing";
    }
} else {
    // Invalid request method
    http_response_code(400);
    echo "Invalid request method";
}

// Closing the database connection
$conn->close();
?>
