<?php
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

    // Performing SQL query to insert data into the database
    $sql = "INSERT INTO users (ID, fullName, email, phoneNumber, password, programCode, semester, college, roomNumber)
            VALUES ('$id', '$fullName', '$email', '$phoneNumber', '$password', '$programCode', '$semester', '$college', '$roomNumber')";

    // $rs = mysqli_query($conn, $sql);

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Closing the database connection
$conn->close();
?>
