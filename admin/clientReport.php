<?php

//database connection
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'smallproject';

// Try connect to database 
$connection = mysqli_connect($host, $user, $password, $database);

if (!$connection) {
  die("Conection failed" .  mysqli_connect_error());
} else {
  // echo "Connection Successful";
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Client Report</title>
  <link rel="stylesheet" href="./clientReport.css" />
  <link rel="stylesheet" href="font-awesome.css">

<body>

  <!-- Nav Bar -->
  <div id='' nav' class="nav ">
    <div class="title_box">
      <h2>Client Report<a></h2>
    </div>
    <a class="close_box" href="./admin.php">Close</a>
  </div>

  <!-- Search Box -->
  <form action="#" method="get" id="search" class="search-box ">
    <button class="btn-search"><i class="fa fa-search" aria-hidden="true"></i></button>
    <input type="text" name="id" class="input-search" placeholder="Type ReportID to search..." />
  </form>





  <!-- Table List -->
  <div class="container " id="container">

    <ul class="responsive-table">
      <li class="table-header">
        <div class="col col-1">Report ID</div>
        <div class="col col-2">User ID</div>
        <div class="col col-3">Repairman ID</div>
        <div class="col col-4">Feedback</div>
        <div class="col col-5">Date Created</div>
      </li>
      <?php

      if (isset($_GET['id'])) {
        if ($_GET['id'] == "*") {
          echo "<script>location.href = 'clientReport.php';</script>";
        }
        $id = $_GET['id'];

        $query = "SELECT * FROM reports where reportId='$id'";
        $results = mysqli_query($connection, $query);
        if (mysqli_num_rows($results) > 0) {
          while ($row = mysqli_fetch_assoc($results)) {

            echo '<li class="table-row">';
            echo '<div class="col col-1">' . $row['reportId'] . '</div>';
            echo '<div class="col col-2">' . $row['userId'] . '</div>';
            echo '<div class="col col-3">' . $row['repairmanId'] . '</div>';
            echo '<div class="col col-4">' . $row['feedback'] . '</div>';
            echo '<div class="col col-5">' . $row['dateCreated'] . '</div>';
            echo '</li>';
          }
          echo "<p>" . mysqli_num_rows($results) .  " record found</p>";
        } else {
          echo "record not found";
        }
      } else {













        // Query Database to fetch employee data
        $queryALL  = "SELECT * FROM reports  ";


        $results = mysqli_query($connection, $queryALL);
        if (mysqli_num_rows($results) > 0) {
          while ($row = mysqli_fetch_assoc($results)) {

            echo '<li class="table-row">';
            echo '<div class="col col-1">' . $row['reportId'] . '</div>';
            echo '<div class="col col-2">' . $row['userId'] . '</div>';
            echo '<div class="col col-3">' . $row['repairmanId'] . '</div>';
            echo '<div class="col col-4">' . $row['feedback'] . '</div>';
            echo '<div class="col col-5">' . $row['dateCreated'] . '</div>';
            echo '</li>';
          }
        } else {
          echo "record not found";
        }
      }

      ?>




    </ul>
  </div>

  <!-- <form class='wrapper__delete'>
    <span>Sure to delete ?</span>
    <button class='wrapper__delete_input1' >Yes</button>
    <a class='wrapper__delete_input2' href='./employeeList.php'>No</a>
  </form> -->
  <?php




  ?>





  <script src="https://kit.fontawesome.com/150c325a66.js" crossorigin="anonymous"></script>


</body>

</html>