<?php
 
$label = array( 
	array("y" => 3373.64, "label" => "Germany" ),
	array("y" => 2435.94, "label" => "France" ),
	array("y" => 1842.55, "label" => "China" ),
	array("y" => 1828.55, "label" => "Russia" ),
	array("y" => 1039.99, "label" => "Switzerland" ),
	array("y" => 765.215, "label" => "Japan" ),
	array("y" => 612.453, "label" => "Netherlands" )
);

$link = mysqli_connect ("localhost", "root","");
mysqli_select_db($link, "collegeregistration");

// Establishing a connection to MySQL database       
$servername = "localhost";
$username = "root";      
$password = "";
$dbname = "collegeregistration";

$conn = mysqli_connect($servername, $username, $password, $dbname);

//create connection
$conn = new mysqli ($servername, $username,$password,$dbname);

$test=array();

$count = 0;
$res=mysqli_query($link, "SELECT * FROM response");
//$label = $_POST("purpose", "response freq");


while($row=mysqli_fetch_array($res))
{
    $test[$count]["label"]=$row["Label"];
    $test[$count]["y"]=$row["Amount"];
}

?>


<!DOCTYPE HTML>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
                            
                <canvas id="myChart" style="width:100%; max-width:600px; height: 10cm;"></canvas>

                <div id="myChart"></div>
                
                <script>
                var element = document.getElementById('centeredElement');

                 // Set styles to center the element
                element.style.position = 'absolute';
                element.style.top = '50%';
                element.style.left = '50%';
                element.style.transform = 'translate(-50%, -50%)';
                </script>
                

                <script>
                const xValues = ["KEY", "FORM", "ELECTRIC", "COMPLAINTS", "OTHERS",];
                const yValues = [55, 49, 44, 24, 35];
                const barColors = ["red", "green","blue","orange","brown"];
                
                
                new Chart("myChart", {
                  type: "bar",
                  data: {
                    labels: xValues,
                    datasets: [{
                      backgroundColor: barColors,
                      data: yValues
                    }]
                  },
                  options: {
                    legend: {display: false},
                    title: {
                      display: true,
                    }
                  }
                });
                </script>
</head>
</html>   