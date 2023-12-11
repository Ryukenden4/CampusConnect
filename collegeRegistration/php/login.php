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

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["ID"];
    $password = $_POST["password"];

    // Check if the student checkbox is checked
    if (isset($_POST["student"])) {
        $sql = "SELECT * FROM student WHERE ID='$id' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Login successful for student
            $_SESSION["user_type"] = "student";
            header("Location: /CampusConnect/intermediate/intermediate.html"); // Replace with the actual path
        } else {
            // Login failed for student
            echo "Error: Incorrect Student ID or password. Please try again.";
        }
    } elseif (isset($_POST["staff"])) {
        // Check if the staff checkbox is checked
        $sql = "SELECT * FROM staff WHERE ID='$id' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Login successful for staff
            $_SESSION["user_type"] = "staff";
            header("Location: /CampusConnect/intermediate/intermediateStaff.html"); // Replace with the actual path
        } else {
            // Login failed for staff
            echo "Error: Incorrect Staff ID or password. Please try again.";
        }
    } else {
        // Handle the case where neither student nor staff checkbox is checked
        echo "Error: Please select either Student or Staff checkbox.";
    }
}

// Closing the database connection
$conn->close();
?>
