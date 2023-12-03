<?php
//Connect to the database
$conn = new mysqli("localhost", "username", "password", "database_name");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user-selected month and year
$selectedMonth = $_POST['month'];
$selectedYear = $_POST['year'];

// Construct the date in the format YYYY-MM
$selectedDate = date("$selectedYear-$selectedMonth");

// Perform the database query
$query = "SELECT * FROM bookings WHERE DATE_FORMAT(booking_date, '%Y-%m') = '$selectedDate'";
$result = $conn->query($query);

// Display results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display booking information
        echo "Booking ID: " . $row['booking_id'] . "<br>";
        echo "Booking Date: " . $row['booking_date'] . "<br>";
        // Display other columns as needed
        // ...
    }
} else {
    echo "No bookings found for the selected month and year.";
}

// Close the database connection
$conn->close();

//Populate months 
                $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                foreach ($months as $month) {
                    echo "<option value='$month'>$month</option>";
                }

// Populate years (adjust the range as needed) 
                $currentYear = date("Y");
                for ($year = $currentYear; $year >= ($currentYear - 5); $year--) {
                    echo "<option value='$year'>$year</option>";
                }
?>
