<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegeregistration";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the JSON string from the POST data
    $jsonData = $_POST["jsonData"];

    // Decode the JSON string into a PHP array
    $data = json_decode($jsonData, true);

    // Access the type, value, and programID properties
    $type = $data['type'];
    $value = strtoupper($data['value']); // Convert to uppercase here
    $programID = $data['programID'];

    if ($type == 'name') {
        
        $sql = "UPDATE programme SET programme = '$value' WHERE programID = $programID";
        $result = $conn->query($sql);

        if ($result) {
            echo '<script>
                alert("Edit Program successfully!");
                window.location.href = "/programRegistration/php/staff.php";
                </script>';
        } else {
            echo "Error updating program: " . $conn->error;
        }
    } else if($type == 'place'){
        
        $sql = "UPDATE programme SET place = '$value' WHERE programID = $programID";
        $result = $conn->query($sql);

        if ($result) {
            echo '<script>
                alert("Edit Program successfully!");
                window.location.href = "/programRegistration/php/staff.php";
                </script>';
        } else {
            echo "Error updating program: " . $conn->error;
        }
    } else if($type == 'date'){
        
        $sql = "UPDATE programme SET date = '$value' WHERE programID = $programID";
        $result = $conn->query($sql);

        if ($result) {
            echo '<script>
                alert("Edit Program successfully!");
                window.location.href = "/programRegistration/php/staff.php";
                </script>';
        } else {
            echo "Error updating program: " . $conn->error;
        }
} else {
    echo "Invalid request method.";
}
}
?>
