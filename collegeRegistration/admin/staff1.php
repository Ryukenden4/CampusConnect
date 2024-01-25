<?php
session_start();

// Establishing a connection to the MySQL database
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
$sql = "SELECT s.*, r.roomNumber, r.residentialCollege
        FROM student s
        LEFT JOIN room r ON s.studentID = r.studentID
        WHERE s.status = 'Enable'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['studentID'] . '</td>';
        echo '<td>' . $row['studentFullName'] . '</td>';
        echo '<td>' . $row['studentEmail'] . '</td>';
        echo '<td>' . $row['phoneNumber'] . '</td>';
        echo '<td>' . $row['programCode'] . '</td>';
        echo '<td>' . $row['semester'] . '</td>';

        echo '<td>';
        if ($row['residentialCollege']) {
            echo $row['residentialCollege'];
        } else {
            echo 'Have not applied';
        }
        echo '</td>';

        echo "<td><a href='#' class='room-link' onclick='confirmChangeRoom(\"" . $row["studentID"] . "\", \"" . $row["roomNumber"] . "\")'>" . $row["roomNumber"] . "</a></td>";
        echo "<td><i class='fas fa-trash-alt' style='color: #8b0000; cursor: pointer;' onclick='confirmDelete(" . $row["studentID"] . ")'></i></td>";
        echo '</tr>';
    }

    echo '</tbody>';
} else {
    echo 'No records found.';
}

// Closing the database connection
$conn->close();
?>
