<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegeregistration";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_id = $_SESSION['user_id'];
$sql = "SELECT fullName FROM student WHERE ID='$student_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$studentName = $row['fullName'];

if (isset($_GET['programme'])) {
    $programme = $_GET['programme'];

    $sql = "INSERT INTO `studentprogram` (student_id, studentName, programJoin) VALUES ('" . strtoupper($student_id) . "', '" . strtoupper($studentName) . "', '" . strtoupper($programme) . "')";


    if ($conn->query($sql) === TRUE) {
        // Query executed successfully
        echo '<script>
                alert("Program registration successfully!");
                window.location.href = "/programRegistration/php/student.php";
            </script>';
    } else {
        // Query execution failed
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}
?>