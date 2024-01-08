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
        echo "<td>" . $row["studentId"] . "</td>";
        echo "<td>" . $row["fullName"] . "</td>";
        echo "<td>" . $row["dateofBooking"] . "</td>";
        echo "<td>" . $row["college"] . "</td>";
        echo "<td>" . $row["facilities"] . "</td>";
        echo "<td>" . $row["startTime"] . "</td>";
        echo "<td>" . $row["endTime"] . "</td>";
    }
} else {
    echo "0 results";
}

// Closing the database connection
$conn->close();
?>
