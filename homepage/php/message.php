<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegeregistration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$full_name = isset($_POST['fullName']) ? $_POST['fullName'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';
$phone_number = isset($_POST['Number']) ? $_POST['Number'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

// Insert data into the database
$sql = "INSERT INTO messages (full_name, email, date, phone_number, message) VALUES ('$full_name', '$email', '$date', '$phone_number', '$message')";

if ($conn->query($sql) === TRUE) {
    // Record created successfully
    echo '<script>';
    echo 'alert("Record created successfully!");';
    echo 'window.location.href = "/CampusConnect/homepage/html/index.html";'; // Replace with the actual path
    echo '</script>';
} else {
    // Error in SQL query
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
