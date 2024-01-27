<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "collegeregistration";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!isset($_SESSION['user_id'])) {
        header("Location: \collegeRegistration\html\login.html"); // Redirect to login page
        exit();
    }
    // Retrieve staff (admin) details from the session
    $staffId = $_SESSION['user_id'];


    // Sanitize and get the facility name and place (college) from the form
    $facilityName = $conn->real_escape_string($_POST['facilityName']);
    $college = $conn->real_escape_string($_POST['college']);

    // Insert new facility into the database
    $sql = "INSERT INTO facilities (staffId, facilityName, college) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $staffId, $facilityName, $college);

    $response = array();

    if ($stmt->execute()) {
        $response["success"] = true;
        $response["message"] = "Facility added successfully!";

        // Redirect to another page after successful addition
        header("Location: /facilitiesBooking/html/admin.html");
        exit(); // Ensure that no further code is executed after the redirect
    } else {
        $response["success"] = false;
        $response["message"] = "Error: " . $stmt->error;

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect to the form page if accessed directly
    header("Location: /facilitiesBooking/html/admin.html");
    exit();
}
?>
