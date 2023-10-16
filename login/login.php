<?php
session_start();
include "DbConnection.php";

if (isset($_POST["submit"])) {
  function generateRandomString($length = 10)
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  $email = $_POST['email'];
  $password = $_POST['password'];
  $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
  $userData = mysqli_fetch_row(mysqli_query($connection, $query));
  $token = generateRandomString();

  if (!$userData) {
    echo "<script>location.replace('login.php?message=Invalid%20Username%20Or%20Password');</script>";
    return;
  }

  $userId = $userData[0];
  $_SESSION["authId"] = $userId;
  $_SESSION["token"] = $token;

  $updateTokenQuery = "UPDATE users SET token = '$token' WHERE userId = '$userId'";
  mysqli_query($connection, $updateTokenQuery);

  if ($userData[3] == 'customer') {
    echo "<script>location.replace('../customer/ServiceSuggestion.php');</script>";
  } else if ($userData[3] == 'repairman') {
    // Gavin
    // echo "<script>location.replace('ServiceSuggestion.php');</script>";
  } else {
    echo "<script>location.replace('../admin/admin.php');</script>";
  };
};
?>






<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="login.css">
</head>

<body>
  <div class="wrapper">

    <div class="form-box login">
      <h2>Login</h2>
      <form action="#" method="post">
        <div class="input-box">
          <span class="icon"><ion-icon name="mail"></ion-icon></span>
          <input type="email" name="email" required />
          <label for="">Email</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="password" name="password" required />
          <label for="">Password</label>
          <?php if (isset($_GET["message"])) {
          ?>
            <span class="message"><?php echo $_GET["message"] ?></span>
          <?php
          } ?>
        </div>
        <div class="remember-forgot">
          <label><input type="checkbox" />Remember me</label>
          <a href="../resetPassword/resetPassword.php">Forgot Password?</a>

        </div>
        <button type="submit" name="submit" value="submit" class="btn">Login</button>
        <div class="login-register">
          <p>
            Don't have an account?<a href="../register/register.php" class="register-link">Register</a>
          </p>
        </div>
      </form>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>