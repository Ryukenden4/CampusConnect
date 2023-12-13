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
} else {
  echo "Connected successfully";
}

// Performing SQL query to fetch data from the response table
$sql = "SELECT * FROM response";
$result = $conn->query($sql);

// Checking if there are rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["No"] . "</td>";
        echo "<td>" . $row["fullName"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["typeOfUser"] . "</td>";
        echo "<td>" . $row["date"] . "</td>";
        echo "<td>" . $row["purpose"] . "</td>";
        echo "<td>" . $row["message"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}

// Closing the database connection
$conn->close();
?>
