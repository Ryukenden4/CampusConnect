<?php
session_start();

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

// Fetching data from roommates
$query = "SELECT s.ID, s.fullName, s.email, s.programCode, s.phoneNumber, s.semester, r.residentialCollege, r.roomNumber
          FROM room r
          JOIN student s ON s.ID IN (r.studentID1, r.studentID2, r.studentID3, r.studentID4)
          WHERE r.roomNumber IN (
              SELECT roomNumber
              FROM room
              WHERE studentID1 = ? OR studentID2 = ? OR studentID3 = ? OR studentID4 = ?
          )";

// Assuming you have the logged-in user's ID in the session
$userID = $_SESSION["user_id"];

$stmt = $conn->prepare($query);
$stmt->bind_param("iiii", $userID, $userID, $userID, $userID);
$stmt->execute();
$result = $stmt->get_result();

// Output the HTML table rows
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['fullName'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['programCode'] . "</td>";
        echo "<td>" . $row['phoneNumber'] . "</td>";
        echo "<td>" . $row['semester'] . "</td>";
        echo "<td>" . $row['residentialCollege'] . "</td>";
        echo "<td>" . $row['roomNumber'] . "</td>";
        echo "</tr>";
    }
} else {
    // If the user has not applied for college, you might want to handle this case
    echo "<tr><td colspan='8'>You have not applied for college.</td></tr>";
}

$stmt->close();
$conn->close();
?>
