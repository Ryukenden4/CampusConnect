<?php
if (isset($_GET['id'])) {
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

    $studentId = $_GET['id'];

    // Performing SQL query to update status to 'disabled'
    $sql = "UPDATE student SET status = 'disabled' WHERE ID = $studentId";

    if ($conn->query($sql) === TRUE) {
        // Deletion successful
        echo '<script>
                alert("Student deleted successfully!");
                window.location.href = "staff.html"; 
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
