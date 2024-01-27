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

// Fetch and display only the bookings for the logged-in user
$getBookingsQuery = "SELECT studentId, fullName, dateofBooking, college, facilities, startTime, endTime FROM booking WHERE studentId = ?";
$stmt = $conn->prepare($getBookingsQuery);
$stmt->bind_param("s", $studentId);
$stmt->execute();
$result = $stmt->get_result();

// Process the results and generate the HTML for the table
$htmlOutput = "";
while ($row = $result->fetch_assoc()) {
    $htmlOutput .= "<tr>";
    $htmlOutput .= "<td>" . $row['studentId'] . "</td>";
    $htmlOutput .= "<td>" . $row['fullName'] . "</td>";
    $htmlOutput .= "<td>" . $row['dateofBooking'] . "</td>";
    $htmlOutput .= "<td>" . $row['college'] . "</td>";
    $htmlOutput .= "<td>" . $row['facilities'] . "</td>";
    $htmlOutput .= "<td>" . $row['startTime'] . "</td>";
    $htmlOutput .= "<td>" . $row['endTime'] . "</td>";
    $htmlOutput .= "</tr>";
}

// Send the HTML response
echo $htmlOutput;

// Close the database connection
$conn->close();
?>
