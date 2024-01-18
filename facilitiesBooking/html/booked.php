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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a function to handle the booking logic, replace 'bookSlotFunction' with your actual function.
    bookSlotFunction($_POST['time']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head style="background-color: #f1f1f1;"> 
    <!-- ... (your existing head content) ... -->
</head>
<body>
    <!-- ... (your existing body content) ... -->

    <!-- Booking slots table -->
    <table id="bookingTable">
        <!-- Table headers go here -->

        
    </table>

    <!-- ... (your existing content) ... -->

    <script>
        // ... (your existing script content) ...

        // Function to book a slot
        function bookSlot(time) {
            // Implement the logic to book the selected slot and update the database
            // You may use AJAX to send a request to the server for booking
            const formData = new FormData();
            formData.append('time', time);

            fetch('/path/to/your/php/file.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showBookingSuccess();
                } else {
                    alert('Booking failed. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again later.');
            });
        }

        // ... (your existing script content) ...
    </script>
</body>
</html>
