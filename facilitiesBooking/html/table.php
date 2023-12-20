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
if ($result->num_rows > 0) {
    // Display the fetched data in an HTML table
    echo "<table border='1'>
        <tr>
            <th>Name</th>
            <th>Student ID</th>
            <th>Date of Booking</th>
            <th>Start Time</th>
            <th>End Time</th>
        </tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["studentId"] . "</td>";
        echo "<td>" . $row["dateofBooking"] . "</td>";
        echo "<td>" . $row["startTime"] . "</td>";
        echo "<td>" . $row["endTime"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

// Closing the database connection
$conn->close();
?>
