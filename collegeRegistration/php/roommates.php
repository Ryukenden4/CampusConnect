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

// Initialize student ID and room number variables
$studentID = "";
$roomNumber = "";

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $studentID = $_SESSION['user_id'];
    
    // Retrieve the room number of the logged-in user
    $getRoomNumberQuery = "SELECT roomNumber FROM room WHERE studentID = ?";
    $stmt = $conn->prepare($getRoomNumberQuery);
    $stmt->bind_param("s", $studentID);
    $stmt->execute();
    $stmt->bind_result($roomNumber);
    $stmt->fetch();
    $stmt->close();
} else {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Fetch data from the database with room and student information joined
$sql = "SELECT s.*, r.roomNumber, r.residentialCollege
        FROM student s
        INNER JOIN room r ON s.studentID = r.studentID
        WHERE r.roomNumber = ? AND s.status = 'Enable'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $roomNumber);
$stmt->execute();
$result = $stmt->get_result();

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
    echo '<tbody><tr><td colspan="8">No results found.</td></tr></tbody>';
}

// Closing the database connection
$stmt->close();
$conn->close();
?>
