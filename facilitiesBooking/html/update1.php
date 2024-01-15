<?php
// Assuming you have a database connection established, include your database connection code here.

// Check if the studentId parameter is set
if (isset($_GET['studentId'])) {
    // Sanitize the input to prevent SQL injection
    $studentId = filter_var($_GET['studentId'], FILTER_SANITIZE_NUMBER_INT);

    // Include your database connection code here

    // Perform the deletion
    $query = "DELETE FROM bookings WHERE studentId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $studentId);

    if ($stmt->execute()) {
        echo "Booking deleted successfully!";
    } else {
        echo "Error deleting booking: " . $stmt->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}
?>
