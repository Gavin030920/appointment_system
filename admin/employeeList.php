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
  <title>Employee List</title>
  <link rel="stylesheet" href="./employeeList.css" />
  <link rel="stylesheet" href="font-awesome.css">

<body>

  <!-- Nav Bar -->
  <div id='' nav' class="nav ">
    <div class="title_box">
      <h2>Employee List<a></h2>
    </div>
    <a class="close_box" href="./admin.php">Close</a>
  </div>

  <!-- Search Box -->
  <form action="#" method="get" id="search" class="search-box ">
    <button class="btn-search"><i class="fa fa-search" aria-hidden="true"></i></button>
    <input type="text" name="id" class="input-search" placeholder="Type ID to search..." />
  </form>


  <a class="addBtn" id="addBtn" href="./employeeListAdd.php">Add</a>


  <!-- Table List -->
  <div class="container " id="container">

    <ul class="responsive-table">
      <li class="table-header">
        <div class="col col-1">UserId</div>
        <div class="col col-2">Name</div>
        <div class="col col-3">Email</div>
        <div class="col col-4">Password</div>
        <div class="col col-5">Action</div>
      </li>
      <?php

      if (isset($_GET['id'])) {
        if ($_GET['id'] == "*") {
          echo "<script>location.href = 'employeeList.php';</script>";
        }
        $id = $_GET['id'];

        $query = "SELECT * FROM users where role='repairman' AND userId='$id'";
        $results = mysqli_query($connection, $query);
        if (mysqli_num_rows($results) > 0) {
          while ($row = mysqli_fetch_assoc($results)) {

            echo '<li class="table-row">';
            echo '<div class="col col-1">' . $row['userId'] . '</div>';
            echo '<div class="col col-2">' . $row['username'] . '</div>';
            echo '<div class="col col-3">' . $row['email'] . '</div>';
            echo '<div class="col col-4">' . $row['password'] . '</div>';
            echo '<div class="col col-5">';
            echo " <a class='btn_delete' href='./employeeList.php?btnIdDeleteConfirmation=" . $row['userId'] . "'>Delete</a>'";
            echo "  <a class='btn_edit' href='./employeeListEdit.php?btnIdEditInformation=" . $row['userId'] . "'>Edit</a>'";
            echo '</div>';
            echo '</li>';

            if (isset($_GET["btnIdDeleteConfirmation"])) {
              echo "<div class='bg-blur'></div>";
              echo "<form class='wrapper__delete' >";
              echo "    <span>Sure to delete ?</span>";
              echo "    <a class='wrapper__delete_input1'href='./employeeList.php?btnIdDelete=" . $_GET['btnIdDeleteConfirmation'] . "'>Yes<a/>";
              echo "    <a class='wrapper__delete_input2'href='./employeeList.php' >No</a>";
              echo "</form>";
            } else {
            }
          }
          echo "<p>" . mysqli_num_rows($results) .  " record found</p>";
        } else {
          echo "record not found";
        }
      } else {




        // Query Database to fetch employee data
        $queryALL  = "SELECT * FROM users where role='repairman'  ";


        $results = mysqli_query($connection, $queryALL);
        if (mysqli_num_rows($results) > 0) {
          while ($row = mysqli_fetch_assoc($results)) {

            echo '<li class="table-row">';
            echo '<div class="col col-1">' . $row['userId'] . '</div>';
            echo '<div class="col col-2">' . $row['username'] . '</div>';
            echo '<div class="col col-3">' . $row['email'] . '</div>';
            echo '<div class="col col-4">' . $row['password'] . '</div>';
            echo '<div class="col col-5">';
            echo "  <a class='deleteBtn' href='./employeeList.php?btnIdDeleteConfirmation=" . $row['userId'] . "'>Delete</a>";
            echo "  <a class='btn_edit' href='./employeeListEdit.php?btnIdEditInformation=" . $row['userId'] . "'>Edit</a>";
            echo '</div>';
            echo '</li>';

            if (isset($_GET["btnIdDeleteConfirmation"])) {
              echo "<div class='bg-blur'></div>";
              echo "<form class='wrapper__delete' >";

              echo "    <span>Sure to delete ?</span>";
              echo "    <a class='wrapper__delete_input1'href='./employeeList.php?btnIdDelete=" . $_GET['btnIdDeleteConfirmation'] . "'>Yes<a/>";
              echo "    <a class='wrapper__delete_input2'href='./employeeList.php' >No</a>";
              echo "</form>";
              echo "<script src='./employeeList.js'></script>";
              // echo "<script src='./employeeList.js'></script>";
            } else {
            }
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



  if (isset($_GET["btnIdDelete"])) {

    // echo "Delete". $_GET["btnIdDelete"];
    $queryDelete = "DELETE FROM `users` WHERE userId='" . $_GET["btnIdDelete"]  . "'";
    // echo $queryDelete;
    $resultDelete = mysqli_query($connection, $queryDelete);
    if (mysqli_query($connection, $queryDelete)) {
      echo "Record Deleted Sucessfully";
      echo "<script>location.href = 'employeeList.php';</script>";
    } else {
      echo "Record has not been updated. ";
    }
    mysqli_close($connection);
  } else {
  }

  ?>





  <script src="https://kit.fontawesome.com/150c325a66.js" crossorigin="anonymous"></script>


</body>

</html>