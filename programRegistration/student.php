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

// Performing SQL query to fetch data from the student table with status "enable"
$sql = "SELECT * FROM programme WHERE status = 'enable'";
$result = $conn->query($sql);

// Checking if there are rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["no"] . "</td>";
        echo "<td>" . $row["programme"] . "</td>";
        echo "<td>" . $row["place"] . "</td>";
        echo "<td>" . $row["date"] . "</td>";
        // echo "<td>" . $row["college"] . "</td>";
        // echo "<td>" . $row["roomNumber"] . "</td>"
    }
} else {
    echo "0 results";
}

// Closing the database connection
$conn->close();
?>
