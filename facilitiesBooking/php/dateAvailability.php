<?php
    $con = mysqli_connect('localhost', 'root');

    if($con){
        echo "Connection Successful";
    }
    else {
        echo "Connection Failed";
    }
    mysqli_select_db($con, 'datebooking');

    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    $query = "INSERT INTO date (day, month, year) VALUES ('$day', '$month', '$year')";

    mysqli_query($con, $query);
    header('location: dateAvailability');

?>
