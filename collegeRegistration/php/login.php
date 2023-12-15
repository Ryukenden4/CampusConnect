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
        $stmt = $conn->prepare("SELECT * FROM student WHERE ID=?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];

            if (password_verify($password, $hashedPassword)) {
                // Login successful for student
                $_SESSION["user_type"] = "student";
                header("Location: /CampusConnect/intermediate/student.html"); // Replace with the actual path
            } else {
                // Login failed for student
                echo "Error: Incorrect Student ID or password. Please try again.";
            }
        } else {
            // User not found
            echo "Error: User not found.";
        }

        $stmt->close();
    } elseif (isset($_POST["staff"])) {
        $stmt = $conn->prepare("SELECT * FROM staff WHERE ID=?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];

            if (password_verify($password, $hashedPassword)) {
                // Login successful for staff
                $_SESSION["user_type"] = "staff";
                header("Location: /CampusConnect/intermediate/staff.html"); // Replace with the actual path
            } else {
                // Login failed for staff
                echo "Error: Incorrect Staff ID or password. Please try again.";
            }
        } else {
            // User not found
            echo "Error: User not found.";
        }

        $stmt->close();
    } else {
        // Handle the case where neither student nor staff checkbox is checked
        echo "Error: Please select either Student or Staff checkbox.";
    }
}

// Closing the database connection
$conn->close();
?>
