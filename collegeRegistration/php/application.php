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

    $roomNumber = $_POST["roomNumber"];
    $residentialCollege = $_POST["college"];

    // Check if the room number is within the allowed range (1101-1412)
    if ($roomNumber < 1101 || $roomNumber > 1412) {
        echo '<script>
                alert("Invalid room number. Please choose a room number between 1101 and 1412.");
                window.location.href = "/collegeRegistration/html/collegeApply.html";
              </script>';
        exit();
    }

    // Check if the room already exists
    $checkRoomExistsQuery = "SELECT * FROM room WHERE roomNumber = ? AND residentialCollege = ?";
    $stmt = $conn->prepare($checkRoomExistsQuery);
    $stmt->bind_param("ss", $roomNumber, $residentialCollege);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Room already exists, find the first available studentID column
        $row = $result->fetch_assoc();
        $availableColumn = findAvailableColumn($row);

        if ($availableColumn !== false) {
            // Update the existing record with the student's information
            $updateQuery = "UPDATE room SET $availableColumn = ? WHERE roomNumber = ? AND residentialCollege = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("sss", $userID, $roomNumber, $residentialCollege);

            if ($updateStmt->execute()) {
                // Application successful
                echo '<script>
                        alert("Application successful!");
                        window.location.href = "/intermediate/student.html";
                      </script>';
            } else {
                // Application failed
                echo "Error: " . $conn->error;
            }
        } else {
            // No available column found, show an error message
            echo '<script>
                    alert("Room is already full. Please choose another room.");
                    window.location.href = "/collegeRegistration/html/collegeApply.html";
                  </script>';
        }
    } else {
        // Room does not exist, create a new row for the application
        $insertQuery = "INSERT INTO room (roomNumber, residentialCollege, studentID1) VALUES (?, ?, ?)";
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
}

// Closing the database connection
$conn->close();

// Function to find the first available studentID column
function findAvailableColumn($row) {
    $columns = ['studentID1', 'studentID2', 'studentID3', 'studentID4'];
    
    foreach ($columns as $column) {
        if ($row[$column] === NULL) {
            return $column;
        }
    }

    return false; // No available column found
}
?>
