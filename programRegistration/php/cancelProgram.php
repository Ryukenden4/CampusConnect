<?php
session_start();

if (isset($_GET['programJoin'])) {
    // Establishing a connection to MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "collegeregistration";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $student_id = $_SESSION['user_id'];
    $programJoin = mysqli_real_escape_string($conn, $_GET['programJoin']);

    // Enclose string values in single quotes in the SQL query
    $sql = "UPDATE `studentprogram` SET status = 'disabled' WHERE programJoin = '$programJoin' AND student_id = '$student_id'";

    if ($conn->query($sql) === TRUE) {
        // Update successful
        echo '<script>
                alert("Program deleted successfully!");
                window.location.href = "/programRegistration/php/programJoin.php";
            </script>';
    } else {
        // Update failed
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Closing the database connection
    $conn->close();
} else {
    echo "Invalid request";
}
?>
