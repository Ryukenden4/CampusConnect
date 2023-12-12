
<?php

if(isset($_POST['submit'])){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $name = $_POST['name'];
        $dob = $_POST['dob'];       

        // Establishing a connection to MySQL database       
        $servername = "localhost";
        $username = "root";      
        $password = "";
        $dbname = "collegeregistration";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        //create connection
        $conn = new mysqli ($servername, $username,$password,$dbname);

        if(mysqli_connect_errno()){
            die('Connect Error ('.mysqli_connect_errno().')'
            .mysqli_connect_errno());
        } else {
        
        // SQL to insert data into the table
        $sql = "INSERT INTO booking(name, dob) 
            VALUES ('$name', '$dob')";
    
            // Execute SQL query
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
           // Close the connection
           $conn->close();
        }

    }
}
?>