<?php
// staff.php

// Connect to the database (similar to register.php)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegeregistration";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch student data from the database
$sql = "SELECT * FROM student";
$result = $conn->query($sql);

// Check if there are rows in the result set
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ID"] . "</td>";
        echo "<td>" . $row["fullName"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["phoneNumber"] . "</td>";
        echo "<td>" . $row["programCode"] . "</td>";
        echo "<td>" . $row["semester"] . "</td>";
        echo "<td>" . $row["college"] . "</td>";
        echo "<td>" . $row["roomNumber"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>No data found</td></tr>";
}

// Close the database connection
$conn->close();
?>
