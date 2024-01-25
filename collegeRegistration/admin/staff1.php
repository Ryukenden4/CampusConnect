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

// Initialize the filter conditions
$filterConditions = array();

// Check if filter parameters are present in the query string
if (isset($_GET['filter']) && isset($_GET['value'])) {
    $filterColumn = $_GET['filter'];
    $filterValue = $_GET['value'];

    // Validate filter column (prevent SQL injection)
    $allowedColumns = array('ID', 'fullName', 'email', 'phoneNumber', 'programCode', 'semester', 'residentialCollege', 'roomNumber');
    if (in_array($filterColumn, $allowedColumns)) {
        $filterConditions[] = "$filterColumn = '$filterValue'";
    }
}

// Performing SQL query to fetch data from the room and student tables with applied filters
$sql = "SELECT student.ID, student.fullName, student.email, student.phoneNumber, student.programCode, student.semester, room.roomNumber, room.residentialCollege
        FROM student
        LEFT JOIN room ON student.ID = room.studentID1 OR student.ID = room.studentID2 OR student.ID = room.studentID3 OR student.ID = room.studentID4";

// Add filter conditions to the query
if (!empty($filterConditions)) {
    $sql .= " WHERE " . implode(' AND ', $filterConditions);
}

// Add condition to filter students with status 'Enable'
$sql .= " AND student.status = 'Enable'";

$result = $conn->query($sql);

// Checking if there are rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ID"] . "</td>";
        echo "<td>" . $row["fullName"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["phoneNumber"] . "</td>";
        echo "<td>" . $row["programCode"] . "</td>";
        echo "<td>" . $row["semester"] . "</td>";

        if ($row["roomNumber"] != null && $row["residentialCollege"] != null) {
            // If roomNumber and residentialCollege are not null, display the room information
            echo "<td>" . $row["residentialCollege"] . "</td>";
        } else {
            // If roomNumber and residentialCollege are null, display "Have not applied"
            echo "<td>Have not applied</td>";
        }

        echo "<td><a href='#' class='room-link' onclick='confirmChangeRoom(\"" . $row["ID"] . "\", \"" . $row["roomNumber"] . "\")'>" . $row["roomNumber"] . "</a></td>";
        echo "<td><i class='fas fa-trash-alt' style='color: #8b0000; cursor: pointer;' onclick='confirmDelete(" . $row["ID"] . ")'></i></td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}

// Closing the database connection
$conn->close();
?>
