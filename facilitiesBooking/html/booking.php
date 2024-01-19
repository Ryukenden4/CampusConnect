<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegeregistration";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page
    exit();
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentId = $_SESSION['user_id']; // Use studentId from session
    $fullName = $conn->real_escape_string($_POST["fullName"]);
    $dateofBooking = $conn->real_escape_string($_POST["dateofBooking"]);
    $college = $conn->real_escape_string($_POST["college"]);
    $facilities = $conn->real_escape_string($_POST["facilities"]);
    $startTime = $conn->real_escape_string($_POST["startTime"]);
    $endTime = $conn->real_escape_string($_POST["endTime"]);

    $sql = "INSERT INTO booking (studentId, fullName, dateofBooking, college, facilities, startTime, endTime) 
            VALUES ('$studentId', '$fullName', '$dateofBooking', '$college', '$facilities', '$startTime', '$endTime')";

    if ($conn->query($sql) === TRUE) {
        header("Location: studentList.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Process JSON data received from AJAX request
$json_data = file_get_contents("php://input");
$booking_data = json_decode($json_data);

// Extract data from JSON
$studentId = $_SESSION['user_id']; // Use studentId from session
$fullName = $conn->real_escape_string($booking_data->fullName);
$dateofBooking = $conn->real_escape_string($booking_data->dateofBooking);
$college = $conn->real_escape_string($booking_data->college);
$facilities = $conn->real_escape_string($booking_data->facilities);
$startTime = $conn->real_escape_string($booking_data->startTime);
$endTime = $conn->real_escape_string($booking_data->endTime);

// Perform database insertion
$sql = "INSERT INTO booking (studentId, fullName, dateofBooking, college, facilities, startTime, endTime) 
        VALUES ('$studentId', '$fullName', '$dateofBooking', '$college', '$facilities', '$startTime', '$endTime')";

if ($conn->query($sql) === TRUE) {
    // Send success response
    echo json_encode(array("success" => true));
} else {
    // Send error response
    echo json_encode(array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error));
}

// Close the database connection
$conn->close();
?>
