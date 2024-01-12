<?php
session_start();

// Validate form data and save it to the database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract user-specific data from session
    $ID = $_POST['ID'];
    $fullName = $_POST['fullName'];
    

    // Extract form data
    $date_of_booking = $_POST['date_of_booking'];
    $college = $_POST['college'];
    $facilities = $_POST['facilities'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Save data to the database (pseudo-code)
    // You would typically use a database connection and execute an INSERT query here

    // Example using MySQLi
    $mysqli = new mysqli("localhost", "root", "", "collegeregistration");

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Prepare and execute the query
    $query = "INSERT INTO booking (studentId, fullName, dateofBooking, college, facilities, startTime, endTime) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ssssssss", $studentId, $fullName, $dateofBooking, $college, $facilities, $startTime, $endTime);
    $stmt->execute();

    // Close the statement and connection
    $stmt->close();
    $mysqli->close();

    // Redirect to a success page or back to the booking form
    header("Location: booking_success.php");
    exit();
} else {
    // Redirect to an error page or back to the booking form
    header("Location: booking_error.php");
    exit();
}
