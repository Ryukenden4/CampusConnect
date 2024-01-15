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

// Get the column name from the query parameter
$columnName = $_GET['column'];

// Performing SQL query to fetch distinct values for the specified column
if ($columnName === 'residentialCollege' || $columnName === 'roomNumber') {
    // Use the room table for residentialCollege and roomNumber
    $sql = "SELECT DISTINCT $columnName FROM room";
} else {
    // Use the student table for other columns
    $sql = "SELECT DISTINCT $columnName FROM student";
}

$result = $conn->query($sql);

// Checking if there are rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row[$columnName] . "'>" . $row[$columnName] . "</option>";
    }
}

// Closing the database connection
$conn->close();
?>
