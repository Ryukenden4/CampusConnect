<?php
// Database connection information
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegeregistration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from facilities table
$getFacilitiesQuery = "SELECT staffId, facilityName, college FROM facilities";
$result = $conn->query($getFacilitiesQuery);

?>

<!-- HTML Section -->
<?php if ($result->num_rows > 0): ?>
    <table style="color: black;">
        <!-- head for table -->
        <thead style="color: black;">
            <tr>
                <!--<th>StaffId</th>
                <th>Facility Name</th>
                <th>College</th>-->
            </tr>
        </thead>

        <!-- body for table -->
        <tbody id="viewFacility">
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['staffId'] ?></td>
                    <td><?= $row['facilityName'] ?></td>
                    <td><?= $row['college'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No facilities data available</p>
<?php endif; ?>

<?php
// Close the database connection
$conn->close();
?>
