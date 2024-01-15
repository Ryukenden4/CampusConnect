<?php
session_start();

    if (isset($_GET['programme'])) {
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

        $programJoin = $_GET['programme'];
        $student_id = $_SESSION['user_id'];
        $studentName = $row['fullname'];


       if($conn){
        // echo "Connection Successfull";
        $mysqli="insert into `studentprogram`(student_id,studentName,programJoin)values('$student_id', '$studentName', '$programJoin')";
        $result=mysqli_query($con,$mysqli);
        if($result){
            echo '<script>
                    alert("Registration successful!");
                    window.location.href = "/programRegistration/php/student.php"; // Replace with the actual path
                </script>';
        }else{
            die(mysqli_error($con));
         }

        }
        else{
            die(mysqli_error($con));
        }
    }

    ?>