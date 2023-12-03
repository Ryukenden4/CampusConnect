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
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $password = $_POST["password"];
    $programCode = $_POST["programCode"];
    $semester = $_POST["semester"];
    $college = $_POST["college"];
    $roomNumber = $_POST["roomNumber"];

    // Check if the student checkbox is checked
    if (isset($_POST["student"])) {
        // Performing SQL query to insert data into the student table
        $sql = "INSERT INTO student (ID, fullName, email, phoneNumber, password, programCode, semester, college, roomNumber)
                VALUES ('$id', '$fullName', '$email', '$phoneNumber', '$password', '$programCode', '$semester', '$college', '$roomNumber')";
    } elseif (isset($_POST["staff"])) {
        // Performing SQL query to insert data into the staff table
        $sql = "INSERT INTO staff (ID, fullName, email, phoneNumber, password)
                VALUES ('$id', '$fullName', '$email', '$phoneNumber', '$password')";
    } else {
        // Handle the case where neither student nor staff checkbox is checked
        echo "Error: Please select either Student or Staff checkbox.";
        exit();
    }

    if ($conn->query($sql) === TRUE) {
        // Registration successful
        echo '<script>
                alert("Registration successful!");
                window.location.href = "/homepage/html/index.html"; // Replace with the actual path
              </script>';
    } else {
        // Registration failed
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Closing the database connection
$conn->close();
?>
