<?php
// Fetch data from the database and display the table

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegeregistration";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM booking";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["studentId"] . "</td>";
        echo "<td>" . $row["fullName"] . "</td>";
        echo "<td>" . $row["dateofBooking"] . "</td>";
        echo "<td>" . $row["college"] . "</td>";
        echo "<td>" . $row["facilities"] . "</td>";
        echo "<td>" . $row["startTime"] . "</td>";
        echo "<td>" . $row["endTime"] . "</td>";
        echo "<td><button onclick=\"deleteBooking(" . $row["studentId"] . ")\">Delete</button></td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
