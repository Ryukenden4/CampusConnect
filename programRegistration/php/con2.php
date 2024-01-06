<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $studentName=$_POST['studentName'];
    $student_id=$_POST['student_id'];
    $programJoin=$_POST['programJoin'];
    


$con=new mysqli('localhost', 'root', '', 'collegeregistration');

if($con){
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

}else{
    die(mysqli_error($con));
}

}
?>