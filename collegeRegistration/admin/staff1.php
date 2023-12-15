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
$sql = "SELECT * FROM student WHERE status = 'enable'";
$result = $conn->query($sql);

// Checking if there are rows returned
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
        echo "<td>
                <button onclick='openEditPopup(" . $row["ID"] . ", \"roomNumber\")'>Edit Room</button>
                <button onclick='openEditPopup(" . $row["ID"] . ", \"college\")'>Edit College</button>
                <button onclick='confirmDelete(" . $row["ID"] . ")'>Delete</button>
              </td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}

// Closing the database connection
$conn->close();
?>
