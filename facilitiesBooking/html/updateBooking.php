<?php
if (isset($_GET['studentId'])) {
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

    // Get the parameter from the GET request
    $studentId = $_GET['studentId'];

    // Performing SQL query to update status to 'disabled' in the database
    $sql = "UPDATE booking SET status = 'disabled' WHERE studentId = $studentId";

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studentId);

    if ($stmt->execute()) {
        // Update successful

        // Output a message indicating success (you can customize this as needed)
        echo "Booking deleted successfully!";
    } else {
        // Update failed
        echo "Error: " . $stmt->error;
    }

    // Closing the database connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}
?>
