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

    // Check if the room is already full
    $checkRoomFullQuery = "SELECT * FROM room WHERE roomNumber = '$roomNumber' AND residentialCollege = '$residentialCollege' AND studentID4 IS NOT NULL";
    $result = $conn->query($checkRoomFullQuery);

    if ($result->num_rows > 0) {
        // Room is already full, check if the user has applied for another room
        $checkUserAppliedQuery = "SELECT * FROM room WHERE (studentID1 = '$userID' OR studentID2 = '$userID' OR studentID3 = '$userID' OR studentID4 = '$userID') AND residentialCollege = '$residentialCollege'";
        $userAppliedResult = $conn->query($checkUserAppliedQuery);

        if ($userAppliedResult->num_rows > 0) {
            // User has already applied for a room, handle accordingly (e.g., show an error message)
            echo '<script>
                    alert("You have already applied for a room. You can apply for only one room per semester.");
                    window.location.href = "/collegeRegistration/html/collegeApply.html";
                  </script>';
        } else {
            // User has not applied for another room, proceed with the application
            $updateQuery = "UPDATE room SET ";
            // Determine which studentID column to update based on the current number of applicants
            $numApplicantsQuery = "SELECT studentID1, studentID2, studentID3, studentID4 FROM room WHERE roomNumber = '$roomNumber' AND residentialCollege = '$residentialCollege'";
            $result = $conn->query($numApplicantsQuery);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row['studentID1'] == NULL) {
                    $updateQuery .= "studentID1 = '$userID'";
                } elseif ($row['studentID2'] == NULL) {
                    $updateQuery .= "studentID2 = '$userID'";
                } elseif ($row['studentID3'] == NULL) {
                    $updateQuery .= "studentID3 = '$userID'";
                } elseif ($row['studentID4'] == NULL) {
                    $updateQuery .= "studentID4 = '$userID'";
                }
            }

            $updateQuery .= " WHERE roomNumber = '$roomNumber' AND residentialCollege = '$residentialCollege'";

            if ($conn->query($updateQuery)) {
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
    } else {
        // Room is not full, create a new row for the application
        $insertQuery = "INSERT INTO room (roomNumber, residentialCollege, studentID1) VALUES ('$roomNumber', '$residentialCollege', '$userID')";

        if ($conn->query($insertQuery)) {
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
?>
