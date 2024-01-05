<?php
 // Establish a connection to MySQL database
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "collegeregistration";

 $conn = mysqli_connect($servername, $username, $password, $dbname);

 // Check the connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }

if (isset($_GET['id'])) {
    $studentId = $_GET['id'];

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["newRoomNumber"])) {
        $newRoomNumber = $_POST["newRoomNumber"];

        // Performing SQL query to update room number
        $sql = "UPDATE room SET roomNumber = '$newRoomNumber' WHERE studentID1 = '$studentId' OR studentID2 = '$studentId' OR studentID3 = '$studentId' OR studentID4 = '$studentId'";

        if ($conn->query($sql) === TRUE) {
            // Room number update successful
            echo "Room number updated successfully!";
        } else {
            // Room number update failed
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Closing the database connection
        $conn->close();
    } else {
        // Display the form to update room number
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update Room Number</title>
        </head>
        <body>
            <h2>Update Room Number</h2>
            <form method="post" action="">
                <label for="newRoomNumber">New Room Number:</label>
                <input type="text" id="newRoomNumber" name="newRoomNumber" required>
                <input type="submit" value="Update Room Number">
            </form>
        </body>
        </html>
        <?php
    }
} else {
    echo "Invalid request";
}
?>
