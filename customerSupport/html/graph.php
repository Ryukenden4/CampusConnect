<?php

// Establishing a connection to MySQL database       
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

// Get data for a specific month (e.g., January 2023)
$selectedMonth = '2023-12'; // Replace this with the desired month and year

$sql = "SELECT purpose, COUNT(*) as purpose_count 
        FROM response 
        WHERE DATE_FORMAT(date, '%Y-%m') = '$selectedMonth' 
        GROUP BY purpose";

$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close connection
$conn->close();

// Convert data to JSON format and send it
header('Content-Type: application/json');
echo json_encode($data);
?>
