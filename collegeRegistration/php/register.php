<?php
session_start();

// Set the default timezone to Malaysian time
date_default_timezone_set('Asia/Kuala_Lumpur');

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
    // Validate and sanitize input
    $id = mysqli_real_escape_string($conn, $_POST["ID"]);
    $fullName = ucwords(mysqli_real_escape_string($conn, $_POST["fullName"])); // Capitalize each word in full name
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST["phoneNumber"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password
    $programCode = strtoupper(mysqli_real_escape_string($conn, $_POST["programCode"])); // Uppercase the program code
    $semester = mysqli_real_escape_string($conn, $_POST["semester"]);
    $college = ucwords(mysqli_real_escape_string($conn, $_POST["college"])); // Capitalize each word in college name
    $roomNumber = mysqli_real_escape_string($conn, $_POST["roomNumber"]);

    // Validate residential college
    $allowedColleges = array("Manukan", "Mabul", "Mantanani");
    if (!in_array($college, $allowedColleges)) {
        echo '<script>
                alert("Invalid residential college. Please choose either Manukan, Mabul, or Mantanani.");
                window.location.href = "/CampusConnect/collegeRegistration/html/register.html";
              </script>';
        exit();
    }

    // Check if the user has already registered in the selected room...
    $checkRoomQuery = "SELECT COUNT(*) as count FROM student WHERE ID = '$id' AND roomNumber = '$roomNumber'";
    $checkRoomResult = $conn->query($checkRoomQuery);

    if ($checkRoomResult->num_rows > 0) {
        $row = $checkRoomResult->fetch_assoc();
        if ($row["count"] > 0) {
            echo '<script>
                    alert("You have already registered in this room. Please choose another room.");
                    window.location.href = "/CampusConnect/collegeRegistration/html/register.html";
                  </script>';
            exit();
        }
    }

    // Check if the selected room has reached its maximum capacity...
    $checkRoomCapacityQuery = "SELECT COUNT(*) as count FROM student WHERE roomNumber = '$roomNumber'";
    $checkRoomCapacityResult = $conn->query($checkRoomCapacityQuery);

    if ($checkRoomCapacityResult->num_rows > 0) {
        $row = $checkRoomCapacityResult->fetch_assoc();
        if ($row["count"] >= 4) {
            echo '<script>
                    alert("This room is full. Please choose another room.");
                    window.location.href = "/CampusConnect/collegeRegistration/html/register.html";
                  </script>';
            exit();
        }
    }

    // Current date and time
    $registrationDateTime = date('Y-m-d H:i:s');

    // Status is set to 'Enable' upon registration
    $status = 'Enable';

    // Performing SQL query to insert data into the student table
    $stmt = $conn->prepare("INSERT INTO student (ID, fullName, email, phoneNumber, password, programCode, semester, college, roomNumber, registrationDateTime, status) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $id, $fullName, $email, $phoneNumber, $password, $programCode, $semester, $college, $roomNumber, $registrationDateTime, $status);

    if ($stmt->execute()) {
        // Registration successful
        echo '<script>
                alert("Registration successful!");
                window.location.href = "/CampusConnect/homepage/html/index.html"; // Replace with the actual path
              </script>';
    } else {
        // Registration failed
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Closing the database connection
$conn->close();
?>
