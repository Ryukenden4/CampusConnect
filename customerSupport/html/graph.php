<?php

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

// Get data for specific months and years
$selectedMonths = ['2024-01', '2024-02']; // Replace this with the desired months and years

// Use prepared statement to prevent SQL injection
$sql = "SELECT purpose, COUNT(*) as purpose_count 
        FROM response 
        WHERE DATE_FORMAT(date, '%Y-%m') IN (";

// Build the placeholders for each month and year
$sql .= implode(',', array_fill(0, count($selectedMonths), '?'));
$sql .= ")
        GROUP BY purpose";

$stmt = $conn->prepare($sql);

// Bind parameters dynamically
$types = str_repeat('s', count($selectedMonths));
$stmt->bind_param($types, ...$selectedMonths);
$stmt->execute();

$result = $stmt->get_result();

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close statement and connection
$stmt->close();
$conn->close();

// Convert data to JSON format and send it
header('Content-Type: application/json');
echo json_encode($data);
?>
