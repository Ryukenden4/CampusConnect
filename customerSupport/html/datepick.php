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
    // Retrieve the search month from the form
    $searchMonth = $_GET["search_month"];

    // Calculate the date range based on the selected month
    list($year, $month) = explode("-", $searchMonth);

    $startDate = date("$year-$month-01");
    $endDate = date("Y-m-t", strtotime($startDate));

    // Perform the SQL query based on the date range
    $sql = "SELECT * FROM response WHERE date BETWEEN '$startDate' AND '$endDate'";

    // Execute the query
    $result = $conn->query($sql);

    // Display the count of responses
    $responseCount = $result->num_rows;
    echo "<p>Total Responses: $responseCount</p>";

    if ($responseCount > 0) {
        // Display the results in an HTML table with some basic styles
        echo "<style>
            table {
                border-collapse: collapse;
                border-spacing: 0;
                width: 100%;
                border: 1px solid #ddd;
            }

            th, td {
                text-align: left;
                padding: 16px;
            }

            tr:nth-child(even) {
                background-color: transparent;
            }

            // Add your existing table styles here...

            main.table {
                width: 82vw;
                height: 90vh;
                background-color: #fff5;
                backdrop-filter: blur(7px);
                box-shadow: 0 .4rem .8rem #0005;
                border-radius: .8rem;
                overflow: hidden;
            }
        </style>";

        echo "<table>";
        echo "<tr><th>Name</th><th>Email</th><th>User Type</th><th>Date</th><th>Purpose</th><th>Message</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            // Display or process each row
            echo "<tr>";
            echo "<td>" . $row["fullName"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["typeOfUser"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["purpose"] . "</td>";
            echo "<td>" . $row["message"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        // No results found
        echo "No results found for the specified month and year.";
    }
}

// Close the database connection if needed
$conn->close();

?>
