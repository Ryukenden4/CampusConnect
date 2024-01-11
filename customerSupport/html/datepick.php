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

// Performing SQL query to fetch data from the response table
$sql = "SELECT * FROM response WHERE date = getDate()";
$result = $conn->query($sql);

// Checking if there are rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["fullName"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["typeOfUser"] . "</td>";
        echo "<td>" . $row["date"] . "</td>";
        echo "<td>" . $row["purpose"] . "</td>";
        echo "<td>" . $row["message"] . "</td>";
        echo "</tr>";
    }
    } else {
    echo "0 results";
    }

    
            // Execute SQL queryy
            if ($conn->query($sql) === TRUE) {
                echo "THANKYOU FOR YOUR RESPONSE";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
           
    
    

    
// Close the connection
$conn->close();
?>