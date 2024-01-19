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

    $sql = "INSERT INTO `studentprogram` (student_id, studentName, programJoin,status) VALUES ('" . strtoupper($student_id) . "', '" . strtoupper($studentName) . "', '" . strtoupper($programme) . "','enable')";


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

if (isset($_GET['programJoin'])) {
    $programJoin = $_GET['programJoin'];

    
    $sql = "UPDATE `studentprogram` SET status = 'disabled' WHERE programJoin = '$programJoin' AND student_id = '$student_id'";

    if ($conn->query($sql) === TRUE) {
        // Query executed successfully
        echo '<script>
                alert("Cancel joining program successfully!");
                window.location.href = "/programRegistration/php/programJoin.php";
            </script>';
    } else {
        // Query execution failed
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}


?>