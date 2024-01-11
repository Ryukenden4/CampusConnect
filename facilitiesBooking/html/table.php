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

// Performing SQL query to fetch data from the response table
$sql = "SELECT * FROM booking";
$result = $conn->query($sql);

// Checking if there are rows returned
echo "<tbody id='studentData'>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["studentId"] . "</td>";
    echo "<td>" . $row["fullName"] . "</td>";
    echo "<td>" . $row["dateofBooking"] . "</td>";
    echo "<td>" . $row["college"] . "</td>";
    echo "<td>" . $row["facilities"] . "</td>";
    echo "<td>" . $row["startTime"] . "</td>";
    echo "<td>" . $row["endTime"] . "</td>";
    echo "</tr>";
}
echo "</tbody>";

// Closing the database connection
$conn->close();
?>
