<?php
session_start();

$student_id = $_SESSION['user_id'];

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

        $sql = "DELETE FROM `studentprogram` WHERE student_id = '$student_id' AND programJoin = '$programme'";

        if ($conn->query($sql) === TRUE) {
            // Deletion successful
            echo '<script>
                    alert("Program deleted successfully!");
                    window.location.href = "/programRegistration/php/programJoin.php";
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