<?php
session_start();

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


if (isset($_POST['btnRegister'])) {


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




  $username = $_POST["txtName"];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $token = generateRandomString();

  $query = "INSERT INTO `users`(`username`, `password`, `role`, `email`, `token`) VALUES ('$username','$password','customer','$email','$token')";


  if (mysqli_query($connection, $query)) {
    echo "Register successfully ";
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
  <title>Register</title>
  <link rel="stylesheet" href="./register.css" />
</head>

<body>


  <div class="wrapper ">

    <div class="form-box register">
      <h2>Registration</h2>
      <form action="#" method="post">
        <div class="input-box">
          <span class="icon"><ion-icon name="person"></ion-icon></ion-icon></span>
          <input type="text" name="txtName" required />
          <label for="">Username</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="mail"></ion-icon></span>
          <input type="email" name="email" required />
          <label for="">Email</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="password" name="password" required />
          <label for="">Password</label>
        </div>
        <div class="remember-forgot">
          <label><input type="checkbox" name="rememberMe" required />I agree to the terms & conditions</label>

        </div>
        <button type="submit" name="btnRegister" class="btn">Register</button>
        <div class="login-register">
          <p>
            Already have an account?<a href="../login/login.php" class="login-link">Login</a>
          </p>
        </div>
      </form>
    </div>


  </div>


  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>