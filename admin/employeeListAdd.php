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
    //   echo "Connection Successful";
}

?>



<form action='#' method='post' class='wrapper__form'>
    <div class='wrapper__form__input'>
        Username<input type='text' name='userName'>
        Password<input type='password' name='password'>
        Email<input type='email' name='email'>
        Role<input type='text' name='role'>
        Token<input type='text' name='token'>
    </div>
    <div class='wrapper__form__div'><input type='submit' value='Add' name='btnUpdate' class='wrapper__form__div__button'></div>
    <div class='wrapper__form__div'><a href='./employeeList.php'>Back</a></div>
    <form>

        <?php
        if (isset($_POST["btnUpdate"])) {

            $username = $_POST['userName'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $email = $_POST['email'];
            $token = $_POST['token'];



            $query = "INSERT INTO `users`(`username`, `password`, `role`, `email`, `token`) VALUES ('$username','$password','$role','$email','$token')";




            if (mysqli_query($connection, $query)) {
                echo "Record successfully inserted";
            } else {
                echo "Sorry, something went wrong";
            }
            mysqli_close($connection);
        }


        ?>











    </form>







    <style>
        .wrapper__form {
            display: flex;
            flex-direction: column;
            position: relative;
            left: 35%;
            top: 100px;
            width: 400px;
            height: 600px;
        }

        .wrapper__form a {
            text-decoration: none;
            text-align: center;
        }

        .wrapper__form a:hover {
            color: #713abe;
            font-weight: 700;
        }

        .wrapper__form__div {
            display: flex;
            justify-content: center;
            height: 30px;
            margin-bottom: 10px;
        }

        .wrapper__form__div__button {
            width: 70px;

            display: flex;
            justify-content: center;
            border: none;
            outline: none;
            background-color: #713abe;
            color: white;
            cursor: pointer;
            padding: 1px;
            border-radius: 10px;
        }

        .wrapper__form__div__button:hover {
            color: #713abe;
            background-color: white;
            border: 1px solid #713abe;
        }


        .wrapper__form__input {
            display: flex;
            flex-direction: column;
            width: 400px;
            height: 300px;
            font-size: 30px;

        }
    </style>