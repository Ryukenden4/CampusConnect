<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establishing a connection to MySQL database       
$servername = "localhost";
$username = "root";      
$password = "";
$dbname = "collegeregistration";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(mysqli_connect_errno()){
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user ID from the session
    $userID = $_SESSION["user_id"];

    // Get form data
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];       
    $typeOfUser = $_POST['typeOfUser'];      
    $date = $_POST['date'];       
    $purpose = $_POST['purpose'];
    $message = $_POST['message'];

    // SQL to insert data into the table
    $sql = "INSERT INTO response(fullName, email, typeOfUser, date, purpose, message) 
            VALUES ('$fullName', '$email', '$typeOfUser', '$date', '$purpose', '$message')";

    if ($conn->query($sql) === TRUE) {

        // Retrieve user ID from the session
        $userID = $_SESSION["user_id"];
        
        // Insertion successful
        // Store form data in session variables for further use
        $_SESSION['fullName'] = $fullName;
        $_SESSION['email'] = $email;
        $_SESSION['typeOfUser'] = $typeOfUser;
        $_SESSION['date'] = $date;
        $_SESSION['purpose'] = $purpose;
        $_SESSION['message'] = $message;

        // Redirect to a thank-you page
        header("Location: thankyou.html");
        exit();
    } else {
        // Insertion failed
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>
