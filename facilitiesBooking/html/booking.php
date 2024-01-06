
<?php
// Database connection details
$servername = "localhost"; // Replace with your database host
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "collegeregistration"; // Replace with your database name

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if(mysqli_connect_errno()){
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $studentId = $_POST["studentId"];
    $fullName = $_POST["fullName"];
    $dateofBooking = $_POST["dateofBooking"];
    $college = $_POST["college"];
    $facilities = $_POST["facilities"];
    $startTime = $_POST["startTime"];
    $endTime = $_POST["endTime"];

    // SQL query to insert data into the database
    $sql = "INSERT INTO booking (studentId, fullName, dateofBooking, college, facilities, startTime, endTime) 
            VALUES ('$studentId', '$fullName','$dateofBooking', '$college', '$facilities', '$startTime', '$endTime')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Booking successful!"; // You can customize this message
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

// Close the database connection
$conn->close();
?>
