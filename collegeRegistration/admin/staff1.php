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

// Performing SQL query to fetch data from the room and student tables
$sql = "SELECT student.ID, student.fullName, student.email, student.phoneNumber, student.programCode, student.semester, room.roomNumber, room.residentialCollege
        FROM student
        LEFT JOIN room ON student.ID = room.studentID1 OR student.ID = room.studentID2 OR student.ID = room.studentID3 OR student.ID = room.studentID4
        WHERE student.status = 'enable'";

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
        
        if ($row["roomNumber"] != null && $row["residentialCollege"] != null) {
            // If roomNumber and residentialCollege are not null, display the room information
            echo "<td>" . $row["residentialCollege"] . "</td>";
            echo "<td>" . $row["roomNumber"] . "</td>";
        } else {
            // If roomNumber and residentialCollege are null, display "Have not applied"
            echo "<td colspan='2'>Have not applied</td>";
        }

        echo "<td><button onclick='confirmDelete(" . $row["ID"] . ")'>Delete</button></td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}

// Closing the database connection
$conn->close();
?>
