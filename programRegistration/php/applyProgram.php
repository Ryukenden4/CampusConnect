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


    // Assuming $programme is the value you want to check for
$programme = mysqli_real_escape_string($conn, $programme);

$sql_check = "SELECT * FROM studentprogram WHERE student_id = '" . strtoupper($student_id) . "' AND programJoin = '" . strtoupper($programme) . "' AND status = 'enable'" ;

$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    // Data already exists in the database, handle accordingly (e.g., show an error message)
    echo '<script>
                alert("Data already exists in the database");
                window.location.href = "/programRegistration/php/student.php";
            </script>';
} else {
    // Data does not exist, proceed with the insertion
    $sql_insert = "INSERT INTO `studentprogram` (student_id, studentName, programJoin, status) VALUES ('" . strtoupper($student_id) . "', '" . strtoupper($studentName) . "', '" . strtoupper($programme) . "', 'enable')";

    if ($conn->query($sql_insert) === TRUE) {
        // Insertion successful
        echo '<script>
                alert("Program registration successfully!");
                window.location.href = "/programRegistration/php/student.php";
            </script>';
    } else {
        // Insertion failed
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}
    // $sql = "INSERT INTO `studentprogram` (student_id, studentName, programJoin,status) VALUES ('" . strtoupper($student_id) . "', '" . strtoupper($studentName) . "', '" . strtoupper($programme) . "','enable')";


    // if ($conn->query($sql) === TRUE) {
    //     // Query executed successfully
    //     echo '<script>
    //             alert("Program registration successfully!");
    //             window.location.href = "/programRegistration/php/student.php";
    //         </script>';
    // } else {
    //     // Query execution failed
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }
    
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