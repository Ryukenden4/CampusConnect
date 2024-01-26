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

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    

    // Perform the SQL query based on the date range and ENABLE status
    $sql = "SELECT * FROM response WHERE UPPER(status) = 'ENABLE'";

    // Execute the query
    $result = $conn->query($sql);

   // Display the count of responses
   $responseCount = $result->num_rows;
   echo "<p><span style='white-space: nowrap; margin-top: 1cm;'>TOTAL RESPONSE: $responseCount</span></p>";

    if ($responseCount > 0) {
        // Display or process each row
        echo "<style>
            /* Your existing styles */
    
            .delete-btn {
                background-color: #dc3545;
                color: #fff;
                padding: 5px 10px;
                border: none;
                cursor: pointer;
                border-radius: 3px;
            }
        </style>";

        // Fetch and display each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["responseID"] . "</td>";
            echo "<td>" . $row["fullName"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["typeOfUser"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["purpose"] . "</td>";
            echo "<td>" . $row["message"] . "</td>";
            echo "<td><button class='delete-btn' onclick='deleteRow(" . $row['responseID'] . ")'>Delete</button></td>";
            echo "</tr>";
        }

    } else {
        // No results found
        echo "No results found for the specified month, year, and enable status.";
    }

    // Close the database connection if needed
    $conn->close();
}
?>
