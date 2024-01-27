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

// Fetch data from the database
$query = "SELECT * FROM booking";
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
    echo "<td><i class='fas fa-trash-alt delete-icon' style='color: #8b0000; cursor: pointer;' data-row-index='" . $row['studentId'] . "'></i></td>";
    echo "</tr>";
}

// Closing the database connection
$conn->close();
?>