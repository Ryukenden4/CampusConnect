<?php


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

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve the search month from the form
    $searchMonth = $_GET["search_month"];

    // Calculate the date range based on the selected month
    list($year, $month) = explode("-", $searchMonth);

    $startDate = date("$year-$month-01");
    $endDate = date("Y-m-t", strtotime($startDate));

    // Perform the SQL query based on the date range
    $sql = "SELECT * FROM response WHERE date BETWEEN '$startDate' AND '$endDate'";

    // Execute the query
    $result = $conn->query($sql);

    // Get the count of responses
    $countSql = "SELECT COUNT(*) AS responseCount FROM response WHERE date BETWEEN '$startDate' AND '$endDate'";
    $countResult = $conn->query($countSql);

    if ($countResult->num_rows > 0) {
    $responseCountRow = $countResult->fetch_assoc();
    $responseCount = $responseCountRow['responseCount'];

    // Display the count in HTML
    echo "<p>Total Responses: $responseCount</p>";
    } else {
    echo "Error fetching response count.";
    }

    // Add a back button
echo '<button onclick="goBack()">Go Back</button>';

// Adding a simple JavaScript function to go back
echo '<script>
    function goBack() {
        window.history.back();
    }
</script>';


    // Process the query result as needed
    if ($result->num_rows > 0) {

        
        // Display the results in an HTML table with some basic styles
        echo "<style>
        background-image: background-image: url(../assets/img/bk.jpeg); height:30cm;

        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }
    
        th, td {
            text-align: left;
            padding: 16px;
        }
    
        tr:nth-child(even) {
            background-color: transparent;
        }
    
        .center {
            margin-left: auto;
            margin-right: auto;
        }
    
        input[type=text] {
            width: 130px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            background-color: white;
            background-image: url('searchicon.png');
            background-position: 10px 10px; 
            background-repeat: no-repeat;
            padding: 12px 20px 12px 40px;
            -webkit-transition: width 0.4s ease-in-out;
            transition: width 0.4s ease-in-out;
        }
    
        input[type=text]:focus {
            width: 100%;
        
    
          .h1{
            color: #fcfcfc;
            text-align: center;
            font-size: 70px;
            position: relative;
          }
    
          #myInput {
            background-image: url('/css/searchicon.png');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
          }
    
          #myTable {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #ddd;
            font-size: 25px;
          }
    
          #myTable th, #myTable td {
            text-align: left;
            padding: 12px;
          }
    
          #myTable tr {
            border-bottom: 1px solid #ddd;
          }
    
          #myTable tr.header, #myTable tr:hover {
            background-color: transparent;
          }
        }
    
        .table__header {
        width: 100%;
        height: 10%;
        background-color: #fff4;
        padding: .8rem 1rem;
    
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .table__header .input-group {
        width: 35%;
        height: 100%;
        background-color: #fff5;
        padding: 0 .8rem;
        border-radius: 2rem;
    
        display: flex;
        justify-content: center;
        align-items: center;
    
        transition: .2s;
    }
    
    .table__header .input-group:hover {
        width: 45%;
        background-color: #fff8;
        box-shadow: 0 .1rem .4rem #0002;
    }
    
    .table__header .input-group img {
        width: 1.2rem;
        height: 1.2rem;
    }
    
    .table__header .input-group input {
        width: 100%;
        padding: 0 .5rem 0 .3rem;
        background-color: transparent;
        border: none;
        outline: none;
    }
    
    .table__body {
        width: 95%;
        max-height: calc(89% - 1.6rem);
        background-color: #fffb;
        margin: .8rem auto;
        border-radius: .6rem;
    
        overflow: auto;
        overflow: overlay;
    }
    
    .table__body::-webkit-scrollbar{
        width: 0.5rem;
        height: 0.5rem;
    }
    
    .table__body::-webkit-scrollbar-thumb{
        border-radius: .5rem;
        background-color: #0004;
        visibility: hidden;
    }
    
    .table__body:hover::-webkit-scrollbar-thumb{ 
        visibility: visible;
    }
    
    table {
        width: 100%;
    }
    
    td img {
        width: 36px;
        height: 36px;
        margin-right: .5rem;
        border-radius: 50%;
    
        vertical-align: middle;
    }
    
    table, th, td {
        border-collapse: collapse;
        padding: 1rem;
        text-align: left;
    }
    
    thead th {
        position: sticky;
        top: 0;
        left: 0;
        background-color: #d5d1defe;
        cursor: pointer;
        text-transform: capitalize;
    }
    
    tbody tr:nth-child(even) {
        background-color: #0000000b;
    }
    
    tbody tr {
        --delay: .1s;
        transition: .5s ease-in-out var(--delay), background-color 0s;
    }
    
    tbody tr.hide {
        opacity: 0;
        transform: translateX(100%);
    }
    
    tbody tr:hover {
        background-color: #fff6 !important;
    }
    
    tbody tr td,
    tbody tr td p,
    tbody tr td img {
        transition: .2s ease-in-out;
    }
    
    tbody tr.hide td,
    tbody tr.hide td p {
        padding: 0;
        font: 0 / 0 sans-serif;
        transition: .2s ease-in-out .5s;
    }
    
    tbody tr.hide td img {
        width: 0;
        height: 0;
        transition: .2s ease-in-out .5s;
    }
    
    main.table {
        width: 82vw;
        height: 90vh;
        background-color: #fff5;
    
        backdrop-filter: blur(7px);
        box-shadow: 0 .4rem .8rem #0005;
        border-radius: .8rem;
    
        overflow: hidden;
    }
              </style>";

        echo "<table>";
        echo "<tr><th>Name</th><th>Email</th><th>User Type</th><th>Date</th><th>Purpose</th><th>Message</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            // Display or process each row
            echo "<tr>";
            echo "<td>" . $row["fullName"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["typeOfUser"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["purpose"] . "</td>";
            echo "<td>" . $row["message"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";    } else {
        // No results found
        echo "No results found for the specified month and year.";
    }
}

// Close the database connection if needed
$conn->close();

?>
