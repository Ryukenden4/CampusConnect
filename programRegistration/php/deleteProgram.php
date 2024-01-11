    <?php
    if (isset($_GET['programID'])) {
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

        $programID = $_GET['programID'];

        // Performing SQL query to update status to 'disabled'
        $sql = "UPDATE programme SET status = 'disabled' WHERE programID = $programID";

        if ($conn->query($sql) === TRUE) {
            // Deletion successful
            echo '<script>
                    alert("Student deleted successfully!");
                    window.location.href = "/programRegistration/php/staff.php";
                </script>';
        } else {
            // Deletion failed
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Closing the database connection
        $conn->close();
    } else {
        echo "Invalid request";
    }
    ?>