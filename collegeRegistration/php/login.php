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
        $sql = "SELECT * FROM student WHERE studentID='$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the hashed password
            if (password_verify($password, $row["password"])) {
                // Login successful for student
                $_SESSION["user_type"] = "student";
                $_SESSION["user_id"] = $id;
                header("Location: /intermediate/student.html");
            } else {
                // Login failed for student
                echo '<script>
                        alert("Incorrect Student ID or password. Please try again.");
                        window.location.href = "/collegeRegistration/html/login.html"; 
                    </script>';
            }
        } else {
            // User not found
            echo '<script>
                    alert("Incorrect Student ID or password. Please try again.");
                    window.location.href = "/collegeRegistration/html/login.html"; 
                </script>';
        }
    } elseif (isset($_POST["staff"])) {
        // Check if the staff checkbox is checked
        $sql = "SELECT * FROM staff WHERE staffID='$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the hashed password for staff
            if (password_verify($password, $row["password"])) {
                // Login successful for staff
                $_SESSION["user_type"] = "staff";
                $_SESSION["user_id"] = $id;
                header("Location: /intermediate/staff.html");
            } else {
                // Login failed for staff
                echo '<script>
                        alert("Incorrect Staff ID or password. Please try again.");
                        window.location.href = "/collegeRegistration/html/login.html"; 
                    </script>';
            }
        } else {
            // User not found
            echo '<script>
                    alert("Incorrect Staff ID or password. Please try again.");
                    window.location.href = "/collegeRegistration/html/login.html"; 
                </script>';
        }
    } else {
        // Handle the case where neither student nor staff checkbox is checked
        echo '<script>
                alert("Please select either Student or Staff checkbox.");
                window.location.href = "/collegeRegistration/html/login.html"; 
             </script>';
    }
}

// Closing the database connection
$conn->close();
?>
