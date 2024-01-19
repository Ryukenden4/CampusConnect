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

// Check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect or handle the case when the user is not logged in
    header("Location: login.php");
    exit();
}

// Fetch data from the database for the specific user
$userId = $_SESSION['user_id'];
$query = "SELECT * FROM booking WHERE studentId = $userId";
$result = mysqli_query($conn, $query);

// Display data in a table format
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr id='row_" . $row['studentId'] . "'>";
    echo "<td>" . $row['studentId'] . "</td>";
    echo "<td>" . $row['fullName'] . "</td>";
    echo "<td>" . $row['dateofBooking'] . "</td>";
    echo "<td>" . $row['college'] . "</td>";
    echo "<td>" . $row['facilities'] . "</td>";
    echo "<td>" . $row['startTime'] . "</td>";
    echo "<td>" . $row['endTime'] . "</td>";
    echo "</tr>";
}

// Closing the database connection
$conn->close();
?>
