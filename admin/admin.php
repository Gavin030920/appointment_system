<?php
session_start();
include './DbConnection.php';
include './AuthenticateMiddleware.php'


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link rel="stylesheet" href="admin.css">
  </head>
  <body>
    <div class="wrapper_admin">
      <h2>Admin Tool</h2>
      <di class="wrapper_btn_admin">
        <a class="btn_admin" href="./employeeList.php">Employee List</a>
        <a class="btn_admin" href="./merchantRegister.php">Merchant Registration Form</a>
        <a class="btn_admin" href="./clientReport.php">Client Report</a>
      </div>
    </div>
  </body>
</html>
