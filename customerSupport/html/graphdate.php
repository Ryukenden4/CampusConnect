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


// Close statement and connection
$stmt->close();
$conn->close();

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

    // Get the count of responses
    $countSql = "SELECT COUNT(*) AS responseCount FROM response WHERE date BETWEEN '$startDate' AND '$endDate'";
    $countResult = $conn->query($countSql);

    if ($countResult->num_rows > 0) {
    $responseCountRow = $countResult->fetch_assoc();
    $responseCount = $responseCountRow['responseCount'];

    // Get data for specific months and years
$selectedMonths = ['2024-01', '2024-02','2024-03','202']; // Replace this with the desired months and years

// Use prepared statement to prevent SQL injection
$sql = "SELECT purpose, COUNT(*) as purpose_count 
        FROM response 
        WHERE DATE_FORMAT(date, '%Y-%m') IN (";

// Build the placeholders for each month and year
$sql .= implode(',', array_fill(0, count($selectedMonths), '?'));
$sql .= ")
        GROUP BY purpose";

$stmt = $conn->prepare($sql);

// Bind parameters dynamically
$types = str_repeat('s', count($selectedMonths));
$stmt->bind_param($types, ...$selectedMonths);
$stmt->execute();

$result = $stmt->get_result();

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
    }


    // Add a back button
    echo '<button onclick="goBack()">Go Back</button>';

    // Adding a simple JavaScript function to go back
    echo '<script>
    function goBack() {
        window.history.back();
    }
    </script>';

}


// Convert data to JSON format and send it
header('Content-Type: application/json');
echo json_encode($data);
?>
