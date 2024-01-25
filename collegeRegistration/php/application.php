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
    // Retrieve user ID from the session
    $userID = $_SESSION["user_id"];

    // check user's gender from the database
    $getUserGenderQuery = "SELECT gender FROM student WHERE studentID = ?";
    //prevent injection by parameterizing the query
    $stmt = $conn->prepare($getUserGenderQuery);
    $stmt->bind_param("s", $userID);
    $stmt->execute();
    //bind user's gender into $userGender
    $stmt->bind_result($userGender);
    $stmt->fetch();
    $stmt->close();

     // Check if the student's ID exists in the room table
     $checkRoomQuery = "SELECT * FROM room WHERE studentID = ?";
     $stmt = $conn->prepare($checkRoomQuery);
     $stmt->bind_param("s", $userID);
     $stmt->execute();
     $result = $stmt->get_result();
 
     if ($result->num_rows > 0) {
         // If the student's ID is already in the room table, display a message and exit
         echo '<script>
                 alert("You have already applied for college.");
                 window.location.href = "/intermediate/student.html";
               </script>';
         exit();
     }

    $roomNumber = $_POST["roomNumber"];
    $residentialCollege = $_POST["college"];

    // Check if the selected residential college is valid based on user gender
    $allowedColleges = ($userGender == 'Male') ? ['Manukan'] : ['Mabul', 'Mantanani'];

    if (!in_array($residentialCollege, $allowedColleges)) {
        echo '<script>
                alert("Invalid residential college selection for your gender.");
                window.location.href = "/collegeRegistration/html/collegeApply.html";
              </script>';
        exit();
    }

    // Check if the room is full (maximum 4 people per room)
    $checkRoomFullQuery = "SELECT * FROM room WHERE roomNumber = ? AND residentialCollege = ?";
    $stmt = $conn->prepare($checkRoomFullQuery);
    $stmt->bind_param("ss", $roomNumber, $residentialCollege);
    $stmt->execute();
    $result = $stmt->get_result();

    // Count the number of registrations for the specified room
    $registrationsCount = $result->num_rows;

    if ($registrationsCount >= 4) {
        // Room is full, show an error message
        echo '<script>
                alert("Room is already full. Please choose another room.");
                window.location.href = "/collegeRegistration/html/collegeApply.html";
              </script>';
        exit();
    }

    // Room is not full, proceed with the registration
    $insertQuery = "INSERT INTO room (roomNumber, residentialCollege, studentID) VALUES (?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("sss", $roomNumber, $residentialCollege, $userID);

    if ($insertStmt->execute()) {
        // Application successful
        echo '<script>
                alert("Application successful!");
                window.location.href = "/intermediate/student.html";
              </script>';
    } else {
        // Application failed
        echo "Error: " . $conn->error;
    }
}

// Closing the database connection
$conn->close();
?>
