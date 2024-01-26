<?php
session_start();

// Establishing a connection to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegeregistration";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database with room and student information joined
$sql = "SELECT s.*, r.roomNumber, r.residentialCollege
        FROM student s
        LEFT JOIN room r ON s.studentID = r.studentID
        WHERE s.status = 'Enable'";

// Initialize a flag to track if any filter was applied
$filterApplied = false;

// Apply filters if specified
if (isset($_GET['filter']) && isset($_GET['value'])) {
    $filterColumn = $_GET['filter'];
    $filterValue = $_GET['value'];

    // Adjust the SQL query based on the filter column
    if ($filterColumn === 'programCode') {
        $sql .= " AND s.programCode = '$filterValue'";
        $filterApplied = true;
    } elseif ($filterColumn === 'semester') {
        $sql .= " AND s.semester = '$filterValue'";
        $filterApplied = true;
    } elseif ($filterColumn === 'residentialCollege') {
        // Filter by residential college from the room table
        $sql .= " AND r.residentialCollege = '$filterValue'";
        $filterApplied = true;
    } elseif ($filterColumn === 'roomNumber') {
        // Filter by room number from the room table
        $sql .= " AND r.roomNumber = '$filterValue'";
        $filterApplied = true;
    }
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['studentID'] . '</td>';
        echo '<td>' . $row['studentFullName'] . '</td>';
        echo '<td>' . $row['studentEmail'] . '</td>';
        echo '<td>' . $row['phoneNumber'] . '</td>';
        echo '<td>' . $row['programCode'] . '</td>';
        echo '<td>' . $row['semester'] . '</td>';

        echo '<td>';
        if ($row['residentialCollege']) {
            echo $row['residentialCollege'];
        } else {
            echo 'Have not applied';
        }
        echo '</td>';

        echo "<td><a href='#' class='room-link' onclick='editRoomNumber(\"" . $row["studentID"] . "\", \"" . $row["roomNumber"] . "\")'>" . $row["roomNumber"] . "</a></td>";
        echo "<td><i class='fas fa-trash-alt' style='color: #8b0000; cursor: pointer;' onclick='confirmDelete(" . $row["studentID"] . ")'></i></td>";
        echo '</tr>';
    }

    echo '</tbody>';
} else {
    // Check if any filter was applied
    if ($filterApplied) {
        echo '<tbody><tr><td colspan="9">0 results</td></tr></tbody>';
    } else {
        // No filters applied, show all results
        // Alternatively, you can display a default message here
        echo '<tbody><tr><td colspan="9">No data available</td></tr></tbody>';
    }
}

// Closing the database connection
$conn->close();
?>
