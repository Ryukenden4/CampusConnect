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

     // Check if the ID starts with "202" and has a total of 10 digits
     if (!preg_match('/^202\d{7}$/', $id)) {
        // ID format is not valid
        echo '<script>
                alert("Invalid ID format. Please make sure the ID starts with 202 and has a total of 10 digits.");
                window.location.href = "/collegeRegistration/html/register.html"; // Redirect to registration page
              </script>';
        exit(); // Terminate further execution
    }

     // Check if the ID already exists in the database
     $checkIDQuery = "SELECT ID FROM student WHERE ID = '$id'";
     $result = mysqli_query($conn, $checkIDQuery);
 
     if (mysqli_num_rows($result) > 0) {
         // ID already exists, ask the user to log in
         echo '<script>
                 alert("ID already exists. Please log in.");
                 window.location.href = "/collegeRegistration/html/login.html"; // Redirect to login page
               </script>';
         exit(); // Terminate further execution
     }

    $fullName = ucwords(mysqli_real_escape_string($conn, $_POST["fullName"])); // Capitalize each word in full name
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST["phoneNumber"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password
    $gender = ucwords(mysqli_real_escape_string($conn, $_POST["Gender"])); // Capitalize gender
    $programCode = strtoupper(mysqli_real_escape_string($conn, $_POST["programCode"])); // Uppercase the program code
    $semester = mysqli_real_escape_string($conn, $_POST["semester"]);
    
    // Determine user type based on checkbox
    $userType = "";
    if (isset($_POST["student"])) {
        $userType = "student";
    } elseif (isset($_POST["staff"])) {
        $userType = "staff";
    }

    // Current date and time
    $registrationDateTime = date('Y-m-d H:i:s');

    // Status is set to 'Enable' upon registration
    $status = 'Enable';

    // Performing SQL query to insert data based on user type
    if ($userType === "student") {
        $stmt = $conn->prepare("INSERT INTO student (ID, fullName, email, phoneNumber, password, Gender, programCode, semester, registrationDateTime, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $id, $fullName, $email, $phoneNumber, $password, $gender, $programCode, $semester, $registrationDateTime, $status);
    } elseif ($userType === "staff") {
        $stmt = $conn->prepare("INSERT INTO staff (ID, fullName, email, phoneNumber, password, Gender, registrationDateTime, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $id, $fullName, $email, $phoneNumber, $password, $gender, $registrationDateTime, $status);
    }
    
    if ($stmt->execute()) {
        // Registration successful
        echo '<script>
                alert("Registration successful!");
                window.location.href = "/homepage/html/index.html"; // Replace with the actual path
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
