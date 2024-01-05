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

// Check if the user is logged in
if (isset($_SESSION['user_type']) && isset($_SESSION['user_id'])) {
    $userType = $_SESSION['user_type'];
    $userId = $_SESSION['user_id'];

    // Fetch user's name from the database
    $tableName = ($userType === 'student') ? 'student' : 'staff';
    $sql = "SELECT fullName FROM $tableName WHERE ID='$userId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userName = $row['fullName'];

        // Return user data in JSON format
        echo json_encode(['success' => true, 'userType' => $userType, 'userId' => $userId, 'userName' => $userName]);
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found in the database']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
}

// Closing the database connection
$conn->close();
?>
