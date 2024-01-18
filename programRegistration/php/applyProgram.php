<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegeregistration";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$student_id = $_SESSION['user_id'];
$sql = "SELECT fullName FROM student WHERE ID='$student_id'";
$studentName = $_SESSION['fullName'];

if (isset($_GET['programme'])) {
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

    $programme = $_GET['programme'];

    // Performing SQL query to update status to 'disabled'
    $sql = " INSERT INTO 'studentprogram' (student_id, studentName, programJoin) VALUES (('" . strtoupper($student_id) . "', '" . strtoupper($studentName) . "', '" . strtoupper($programme) . "')";

    if ($conn->query($sql) === TRUE) {
        // Deletion successful
        echo '<script>
                alert("Program registration successfully!");
                window.location.href = "/programRegistration/php/student.php";
            </script>';
    } else {
        // Deletion failed
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Closing the database connection
    $conn->close();
} else {
    echo "Invalid request";
}
?>