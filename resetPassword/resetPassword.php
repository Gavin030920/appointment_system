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

if (isset($_POST['btnChange'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = "UPDATE `users` SET `password`='$password' WHERE email='$email'";

  if (mysqli_query($connection, $query)) {
    echo "Change successfully ";
    echo "<script>location.href = '../login/login.php';</script>";
  } else {
    echo "Sorry, something went wrong";
  }
  mysqli_close($connection);
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home Repair System</title>
  <link rel="stylesheet" href="resetPassword.css" />
</head>

<body>
  <div class="container">
    <h2>Reset Password</h2>
    <form action="#" method="post">
      <div class="input-box">
        <span class="icon"><ion-icon name="mail"></ion-icon></span>
        <input type="email" name="email" required />
        <label for="">Email</label>
      </div>
      <div class="input-box">
        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
        <input type="password" name="password" required />
        <label for="">New Password</label>
      </div>
      <button class="btn" name="btnChange">Change Password</button>
  </div>

  </form>

  </div>

  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>