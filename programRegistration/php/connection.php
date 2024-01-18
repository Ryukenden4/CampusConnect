<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $programme=$_POST['programme'];
    $place=$_POST['place'];
    $date=$_POST['date'];
    


$con=new mysqli('localhost', 'root', '', 'collegeregistration');

if($con){
    // echo "Connection Successfull";
    $sql="INSERT INTO `programme` (programme,place,date) VALUES ('" . strtoupper($programme) . "', '" . strtoupper($place) . "', '" . $date . "')";
    $result=mysqli_query($con,$sql);
    if($result){
        echo '<script>
                alert("Registration successful!");
                window.location.href = "/programRegistration/php/staff.php"; // Replace with the actual path
              </script>';
    }else{
        die(mysqli_error($con));
    }

}else{
    die(mysqli_error($con));
}

}
?>