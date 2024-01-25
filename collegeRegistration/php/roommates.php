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

// Retrieve student ID from session
$studentID = $_SESSION['studentID'];

// Fetch student's room information
$sql = "SELECT r.roomNumber, r.residentialCollege
        FROM room r
        WHERE r.studentID = '$studentID'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $roomNumber = $row['roomNumber'];
    $residentialCollege = $row['residentialCollege'];

    // Fetch roommates in the same room and college
    $sqlRoommates = "SELECT s.studentID, s.studentFullName, s.studentEmail, s.phoneNumber
                    FROM room r
                    INNER JOIN student s ON r.studentID = s.studentID
                    WHERE r.roomNumber = '$roomNumber' AND r.residentialCollege = '$residentialCollege' AND r.studentID != '$studentID'";

    $resultRoommates = $conn->query($sqlRoommates);

    if ($resultRoommates->num_rows > 0) {
        echo '<tbody>';

        while ($rowRoommate = $resultRoommates->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $rowRoommate['studentID'] . '</td>';
            echo '<td>' . $rowRoommate['studentFullName'] . '</td>';
            echo '<td>' . $rowRoommate['studentEmail'] . '</td>';
            echo '<td>' . $rowRoommate['phoneNumber'] . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
    } else {
        echo '<tbody><tr><td colspan="4">No roommates found</td></tr></tbody>';
    }
} else {
    echo '<tbody><tr><td colspan="4">You are not assigned to any room</td></tr></tbody>';
}

// Closing the database connection
$conn->close();
?>
