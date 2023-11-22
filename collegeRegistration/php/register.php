<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$servername = "localhost:3306"; // Change this if your MySQL server is on a different host
$username = "root"; // Your MySQL username (default is "root" for XAMPP)
$password = ""; // Your MySQL password (leave it empty for XAMPP)
$database = "collegeregistration"; // Your MySQL database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check the database connection
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
  $repeatPassword = $_POST["repeatPassword"];
  $programCode = $_POST["programCode"];
  $semester = $_POST["semester"];
  $college = $_POST["college"];
  $roomNumber = $_POST["roomNumber"];

  // Validate form data
  if (empty($studentID)) {
    $errorMessages[] = "Student ID is required";
  }

  if (empty($fullName)) {
    $errorMessages[] = "Full name is required";
  }

  if (empty($email)) {
    $errorMessages[] = "Email is required";
  }

  if (empty($phoneNumber)) {
    $errorMessages[] = "Phone number is required";
  }

  if (empty($password)) {
    $errorMessages[] = "Password is required";
  }

  if ($password != $repeatPassword) {
    $errorMessages[] = "Passwords do not match";
  }

  if (empty($programCode)) {
    $errorMessages[] = "Program code is required";
  }

  if (empty($semester)) {
    $errorMessages[] = "Semester is required";
  }

  if (empty($college)) {
    $errorMessages[] = "College is required";
  }

  if (empty($roomNumber)) {
    $errorMessages[] = "Room number is required";
  }

  // Check for errors
  if (!empty($errorMessages)) {
    // Display error messages
    foreach ($errorMessages as $errorMessage) {
      echo $errorMessage . "<br>";
    }
  } else {
    // Insert data into the database
    $sql = "INSERT INTO registration (studentID, fullName, email, phoneNumber, password, programCode, semester, college, roomNumber)
VALUES ('$studentID', '$fullName', '$email', '$phoneNumber', '$password', '$programCode', '$semester', '$college', '$roomNumber')";

    // Execute the query and check for errors
    if ($conn->query($sql) === TRUE) {
      echo "Registration successful!";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
} else {
  // If the form is not submitted via POST, display a message
  echo "Form not submitted!";
}

// Close the database connection
$conn->close();

?>
