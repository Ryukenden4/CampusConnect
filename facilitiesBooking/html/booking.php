<?php
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
    $studentId = $conn->real_escape_string($_POST["studentId"]);
    $fullName = $conn->real_escape_string($_POST["fullName"]);
    $dateofBooking = $conn->real_escape_string($_POST["dateofBooking"]);
    $college = $conn->real_escape_string($_POST["college"]);
    $facilities = $conn->real_escape_string($_POST["facilities"]);
    $startTime = $conn->real_escape_string($_POST["startTime"]);
    $endTime = $conn->real_escape_string($_POST["endTime"]);

    $sql = "INSERT INTO booking (studentId, fullName, dateofBooking, college, facilities, startTime, endTime) 
            VALUES ('$studentId', '$fullName', '$dateofBooking', '$college', '$facilities', '$startTime', '$endTime')";

    if ($conn->query($sql) === TRUE) {
        header("Location: bookedList.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
