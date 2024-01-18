<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $studentName=$_POST['studentName'];
    $student_id=$_POST['student_id'];
    $programJoin=$_POST['programJoin'];
    


    $con=new mysqli('localhost', 'root', '', 'collegeregistration');
    // $mysqli = "UPDATE studentprogram SET studentName= '" . $con->real_escape_string(strtoupper($studentName)) . "'";
    // $mysqli = "UPDATE studentprogram SET student_id= '" . $con->real_escape_string(strtoupper($student_id)) . "'";
    // $mysqli = "UPDATE studentprogram SET ProgramJoin= '" . $con->real_escape_string(strtoupper($programJoin)) . "'";

    if($con){
        // echo "Connection Successfull";
        $mysqli = "INSERT INTO `studentprogram` (student_id, studentName, programJoin) VALUES ('" . strtoupper($student_id) . "', '" . strtoupper($studentName) . "', '" . strtoupper($programJoin) . "')";
        
        $result=mysqli_query($con,$mysqli);
        if($result){
            echo '<script>
                    alert("Registration successful!");
                    window.location.href = "/programRegistration/php/student.php"; // Replace with the actual path
                </script>';
        }else{
            die(mysqli_error($con));
        }

    }else{
        die(mysqli_error($con));
    }

}
?>