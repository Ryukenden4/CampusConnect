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

// Fetch data from the database with room and student information joined
$sql = "SELECT s.*, r.roomNumber, r.residentialCollege
        FROM student s
        INNER JOIN room r ON s.studentID = r.studentID
        WHERE s.status = 'Enable'";

// Add conditions to filter by room number and residential college
if (isset($_SESSION['studentID'])) {
    $studentID = $_SESSION['studentID'];
    // Add condition to filter by the room number the same with the student ID in the session
    $sql .= " AND r.roomNumber = (SELECT roomNumber FROM room WHERE studentID = '$studentID')";
}

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

        echo "<td>" . $row["roomNumber"] . "</td>";
        echo '</tr>';
    }

    echo '</tbody>';
} else {
    echo '<tbody><tr><td colspan="9">0 results</td></tr></tbody>';
}

// Closing the database connection
$conn->close();
?>
