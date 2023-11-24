<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  exit;
}

// Connect to the database
$db = mysqli_connect('localhost:3306', 'root', '', 'college_registration');

// Check connection
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get data from the form
$studentID = $_POST['studentID'];
$fullName = $_POST['fullName'];
$email = $_POST['email'];
$phoneNumber = $_POST['phoneNumber'];
$password = $_POST['password'];
$repeatPassword = $_POST['repeatPassword'];
$programCode = $_POST['programCode'];
$semester = $_POST['semester'];
$college = $_POST['college'];
$roomNumber = $_POST['roomNumber'];

// Check if passwords match
if ($password != $repeatPassword) {
  die("Passwords do not match.");
}

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert data into the database
$sql = "INSERT INTO students (student_id, full_name, email, phone_number, password, program_code, semester, college, room_number) VALUES ('$studentID', '$fullName', '$email', '$phoneNumber', '$hashedPassword', '$programCode', '$semester', '$college', '$roomNumber')";

if (mysqli_query($db, $sql)) {
  echo "Registration successful.";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($db);
}

mysqli_close($db);

?>
