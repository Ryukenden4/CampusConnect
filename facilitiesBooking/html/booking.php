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

// Retrieve user details from the student table
$studentId = $_SESSION['user_id'];
$getUserDetailsQuery = "SELECT fullName FROM student WHERE ID = ?";
$stmt = $conn->prepare($getUserDetailsQuery);
$stmt->bind_param("s", $studentId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fullName = $row['fullName'];
} else {
    // Handle the case when the user is not found in the student table
    echo json_encode(array("success" => false, "message" => "User not found in the student table."));
    exit();
}

$stmt->close();

// Retrieve college from the room table
$getCollegeQuery = "SELECT residentialCollege FROM room WHERE studentID1 = ? OR studentID2 = ? OR studentID3 = ? OR studentID4 = ?";
$stmt = $conn->prepare($getCollegeQuery);
$stmt->bind_param("ssss", $studentId, $studentId, $studentId, $studentId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $college = $row['residentialCollege'];
} else {
    // Handle the case when the user is not found in the room table
    echo json_encode(array("success" => false, "message" => "User not assigned to a room."));
    exit();
}

$stmt->close();

// Process JSON data received from AJAX request
$json_data = file_get_contents("php://input");
$booking_data = json_decode($json_data);
var_dump($booking_data);
// Debugging: Log received POST data to the error log
error_log("Received POST data: " . print_r($_POST, true));

// Extract data from JSON
$studentId = $_SESSION['user_id']; // Use studentId from session
$fullName = $conn->real_escape_string($fullName); // Use fullName from the student table
$dateofBooking = $conn->real_escape_string($booking_data->bookingDate);
$college = $conn->real_escape_string($college); // Use college from the room table
$facilities = $conn->real_escape_string($booking_data->facilities);

// Convert start and end times based on time slots
$startTime = $conn->real_escape_string($booking_data->startTime);
$endTime = $conn->real_escape_string($booking_data->endTime);

// Debugging: Log values to the error log
error_log("Booking Date: " . $dateofBooking);
error_log("Facilities: " . $facilities);
error_log("Start Time: " . $startTime);
error_log("End Time: " . $endTime);

// Perform database insertion using predefined start and end times
$sql = "INSERT INTO booking (studentId, fullName, dateofBooking, college, facilities, startTime, endTime) 
        VALUES ('$studentId', '$fullName', '$dateofBooking', '$college', '$facilities', '$startTime', '$endTime')";

$response = array();

if ($conn->query($sql) === TRUE) {
    $response["success"] = true;
    $response["message"] = "Booking successful!";
} else {
    $response["success"] = false;
    $response["message"] = "Error: " . $sql . "<br>" . $conn->error;
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();
?>
