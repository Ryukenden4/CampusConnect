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

    // Get data for specific months and years
    $selectedMonths = ['2024-01', '2024-02', '2024-03', '2024-04']; // Replace this with the desired months and years
    
    // Retrieve the search month from the form
    $searchMonth = $_GET["search_month"];

    // Calculate the date range based on the selected month
    list($year, $month) = explode("-", $searchMonth);

    $startDate = date("$year-$month-01");
    $endDate = date("Y-m-t", strtotime($startDate));

    // Perform the SQL query based on the date range and ENABLE status
    $sql = "SELECT * FROM response WHERE date BETWEEN '$startDate' AND '$endDate' AND UPPER(status) = 'ENABLE'";

    // Execute the query
    $result = $conn->query($sql);

    // Display the count of responses
    $responseCount = $result->num_rows;
    echo "<p>Total Responses: $responseCount</p>";

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
