<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$servername = "localhost:5500"; // Change this if your MySQL server is on a different host
$username = "root"; // Your MySQL username (default is "root" for XAMPP)
$password = ""; // Your MySQL password (leave it empty for XAMPP)
$database = "collegeregistration"; // Your MySQL database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the form submission only if the method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $studentID = $_POST["studentID"];
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $password = $_POST["password"];
    $programCode = $_POST["programCode"];
    $semester = $_POST["semester"];
    $college = $_POST["college"];
    $roomNumber = $_POST["roomNumber"];

    // Insert data into the database
    $sql = "INSERT INTO registration (studentID, fullName, email, phoneNumber, password, programCode, semester, college, roomNumber) 
    VALUES ('$studentID', '$fullName', '$email', '$phoneNumber', '$password', '$programCode', '$semester', '$college', '$roomNumber')";

    // Execute the query and check for errors
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If the form is not submitted via POST, display a message
    echo "Form not submitted!";
}

// Close the database connection
$conn->close();
?>
