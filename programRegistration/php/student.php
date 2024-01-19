<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en" title="Program Registration">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>College InfoCenter</title>
    <link rel="stylesheet" href="/programRegistration/css/style.css">
    <!-- header n footer css -->
    <link rel="stylesheet" href="/homepage/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/homepage/assets/css/maicons.css">
    <link rel="stylesheet" href="/homepage/assets/css/theme.css">
    <link rel="stylesheet" href="/collegeRegistration/css/footer.css">
    <link rel="stylesheet" href="/collegeRegistration/admin/style.css">

</head>

<body>
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
                        <a class="nav-link active" style="font-size: 14px;" href="/intermediate/student.html">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="registrationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 14px;">
                            Registration
                        </a>
                        <div class="dropdown-menu" aria-labelledby="registrationDropdown">
                            <a class="dropdown-item" href="/collegeRegistration/html/collegeApply.html">College Registration</a>
                            <a class="dropdown-item" href="/programRegistration/php/student.php">Programme Registration</a>
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

    <!-- body section -->
    <main class="table">
        <section class="table__header">
            <div class="tajuk"><h1>Programme Registration</h1></div>
           
        </section>
        <section class="table__body">
            <table>
                <!-- head for table -->
                <thead>
                    <tr>
                        <th> no </th>
                        <th> progam name </th>
                        <th> place </th>
                        <th> date </th>
                        <th><center> Action </center></th>
                    </tr>
                </thead>

               
                <tbody>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "collegeregistration";

                    $conn = new mysqli($servername, $username, $password, $dbname);
                    
                    // Check the connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Performing SQL query to fetch data from the student table with status "enable"
                    $sql = "SELECT * FROM programme WHERE programme.status = 'enable'";
                    $result = $conn->query($sql);

                    if(!$result){
                        die("Invalid query: ".$connection->error);
                    }

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["programID"] . "</td>";
                        echo "<td>" . $row["programme"] . "</td>";
                        echo "<td>" . $row["place"] . "</td>";
                        echo "<td>" . $row["date"] . "</td>";

                        // echo "<td><button onclick=location.href='/programRegistration/php/programJoin.php'>Register</button></td>";
                        
                        echo "<td>
                            <div class='btnRegister' > 
                            <button class='button' onclick='join(\"" . htmlspecialchars($row["programme"]) . "\")'>
                                    Register Program
                                    <svg fill='currentColor' viewBox='0 0 24 24' class='icon'>
                                        <path clip-rule='evenodd' d='M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z' fill-rule='evenodd'></path>
                                    </svg>
                                </button>
                            </div></td>";
                        echo "</tr>";

                        echo "<script>
                        function join(programme) {
                            var join = confirm('Are you sure you want to join this Program?');
                         
                            if (join) {
                               window.location.href = 'applyProgram.php?programme=' + encodeURIComponent(programme);
                            } else {
                                window.location.href = 'student.php';
                            }
                         }
                            </script>";

                    }
                    ?>
                </tbody>
            </table>
        </section>
        <div class="input-field" style="padding-left: 40px;">
            <button type="button" onclick="goBack()" style="background-color: #8b0000; color: white;" class="btn"><i class="fa-solid fa-arrow-left"  style="padding-right: 10px;"></i>Back</button>
        </div>
    </main>

     <!-- footer -->
     <div class="copyright_section">
        <div class="container">
            <p class="copyright_text">2023 All Rights Reserved. Design by <a href="#">Team Muizz</a></p>
        </div>
    </div>

</body>
  <!-- back button javascript -->
  <script>
    function goBack() {
        // Redirect to another HTML file
        window.location.href = '/intermediate/student.html'; 
    }
  </script>


<script src="/homepage/assets/js/jquery-3.5.1.min.js"></script>
<script src="/homepage/assets/js/bootstrap.bundle.min.js"></script>

<script src="https://kit.fontawesome.com/ebf7b9acb5.js" crossorigin="anonymous"></script>

</html>
