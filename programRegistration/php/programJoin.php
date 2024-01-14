<?php
session_start();

// Set the default timezone to Malaysian time
date_default_timezone_set('Asia/Kuala_Lumpur');

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Program</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../css/registerStyle.css"> 
    <link rel="stylesheet" href="/homepage/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/homepage/assets/css/maicons.css">
    <link rel="stylesheet" href="/homepage/assets/css/theme.css">
    <link rel="stylesheet" href="/collegeRegistration/css/footer.css">
    <link rel="stylesheet" href="/programRegistration/css/registerProgram.css">
    <link rel="stylesheet" href="/collegeRegistration/admin/style.css">
</head>
<body>
    <!-- header -->
    <header>
        <link rel="stylesheet" href="/header/css/bootstrap.css">
        <link rel="stylesheet" href="/header/css/maicons.css">
        <link rel="stylesheet" href="/header/css/theme.css">
  
  
        <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
          <div class="container">
              <a class="navbar-brand" href="/intermediate/student.html"><span class="text-primary">College</span> InfoCenter</a>
  
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
  
              <div class="collapse navbar-collapse" id="navbarSupport">
                  <ul class="navbar-nav ml-auto">
                      <li class="nav-item ">
                          <a class="nav-link" style="font-size: 14px;" href="/intermediate/student.html">Home</a>
                      </li>
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="registrationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 14px;">
                              Registration
                          </a>
                          <div class="dropdown-menu" aria-labelledby="registrationDropdown">
                              <a class="dropdown-item" href="/collegeRegistration/html/collegeApply.html">College Student Namelist</a>
                              <a class="dropdown-item" href="/programRegistration/php/student.php">Programme List</a>
                          </div>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" style="font-size: 14px;" href="/facilitiesBooking/html/student.html">Facilities Booking</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" style="font-size: 14px;" href="/customerSupport/html/customer.html">Customer Support</a>
                      </li>
                      <!-- Add this within your navigation bar where you want the logout button to appear -->
                      <li class="nav-item">
                          <form action="/logout/logout.php" method="post">
                              <input type="submit" class="btn btn-primary ml-lg-3" value="Logout">
                          </form>
                      </li>
                  </ul>
              </div> <!-- .navbar-collapse -->
          </div> <!-- .container -->
        </nav>
  
        <script src="/homepage/assets/js/jquery-3.5.1.min.js"></script>
        <script src="/homepage/assets/js/bootstrap.bundle.min.js"></script>
      </header>
    
    <div class="register-container">
        <div class="register">
            <form action="/programRegistration/php/con2.php" method="POST">
                <h1>Register Program</h1>

                <div class="input-box">

                    <!-- program name -->
                    <div class="input-field">
                        <input type="text" name="studentName" placeholder="Name" required>
                        <!-- <i class="bx bxs-user"></i> -->
                    </div>
                    <!-- place -->
                    <div class="input-field">
                        <input type="text" name="student_id" placeholder="ID" required>
                        <!-- <i class="bx bxs-envelope"></i> -->
                    </div>
                    <!-- date -->
                    <div class="input-field">
                        <input type="text" name="programJoin" placeholder="Program Name" required>
                        <!-- <i class="bx bxs-lock"></i> -->
                    </div>
                </div>

                <div class="buttonBackApply">
                  <button type="button" onclick="location.href='/programRegistration/php/student.php'" style="background-color: #8b0000;" class="btn">Cancel</button>
                  <button type="submit" value="submit" class="btn">Add Programme</button>
                </div>

            </form>
        </div>
    </div>

      <!-- footer -->
      <div class="copyright_section">
      <div class="container">
         <p class="copyright_text">2023 All Rights Reserved. Design by <a href="#">Team Muizz</a></p>
      </div>
   </div>
</body>
</html>