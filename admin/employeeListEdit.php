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



if (isset($_GET["btnIdEditInformation"])) {
    $id = $_GET["btnIdEditInformation"];
    $query = "SELECT * FROM users where userId='$id'";
    $results = mysqli_query($connection, $query);

    if (mysqli_num_rows($results) > 0) {
        while ($row = mysqli_fetch_assoc($results)) {


            echo "<form action='#' method='post' class='wrapper__form'>";
            echo "<div class='wrapper__form__input'>";
            echo "User Id<input type='text' name='userId' value='" . $row['userId'] . " (Do not Change)' disabled>";
            echo "Username<input type='text' name='userName' placeholder='" . $row['username'] . "'>";
            echo "Email<input type='email' name='email' placeholder='" . $row['email'] . "'>";
            echo "Role<input type='text' name='role' placeholder='" . $row['role'] . "'>";
            echo " Password<input type='password' name='password' placeholder='" . $row['password'] . "'>";
            echo "</div>";
            echo "<div class='wrapper__form__div'><input type='submit' value='update' name='btnUpdate' class='wrapper__form__div__button'></div>";
            echo "<div class='wrapper__form__div'><a href='./employeeList.php'>Back</a></div>";
        }
    } else {
        echo "No record found";
    }
}


if (isset($_POST["btnUpdate"])) {
    $userid = $_POST['userId'];
    $username = $_POST['userName'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $email = $_POST['email'];


    $id = $_GET["btnIdEditInformation"];
    $query = "UPDATE `users` SET `username`='$username',`password`='$username',`role`='$role',`email`='$email' WHERE userId = '$id'";
    $results = mysqli_query($connection, $query);



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