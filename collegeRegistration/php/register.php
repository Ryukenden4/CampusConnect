<?php
session_start();

// Set the default timezone to Malaysian time
date_default_timezone_set('Asia/Kuala_Lumpur');

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

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $id = mysqli_real_escape_string($conn, $_POST["ID"]);
    $fullName = ucwords(mysqli_real_escape_string($conn, $_POST["fullName"])); // Capitalize each word in full name
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST["phoneNumber"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $gender = ucwords(mysqli_real_escape_string($conn, $_POST["gender"])); // Capitalize gender
    $programCode = strtoupper(mysqli_real_escape_string($conn, $_POST["programCode"])); // Uppercase the program code
    $semester = mysqli_real_escape_string($conn, $_POST["semester"]);
    
    // Determine user type based on checkbox
    $userType = "";
    if (isset($_POST["student"])) {
        $userType = "student";
    } elseif (isset($_POST["staff"])) {
        $userType = "staff";
    }

    // Current date and time
    $registrationDateTime = date('Y-m-d H:i:s');

    // Status is set to 'Enable' upon registration
    $status = 'Enable';

    // Performing SQL query to insert data
    $stmt = $conn->prepare("INSERT INTO $userType (ID, fullName, email, phoneNumber, password, gender, programCode, semester, registrationDateTime, status) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $id, $fullName, $email, $phoneNumber, $password, $gender, $programCode, $semester, $registrationDateTime, $status);

    if ($stmt->execute()) {
        // Registration successful
        echo '<script>
                alert("Registration successful!");
                window.location.href = "/homepage/html/index.html"; // Replace with the actual path
              </script>';
    } else {
        // Registration failed
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Closing the database connection
$conn->close();
?>
