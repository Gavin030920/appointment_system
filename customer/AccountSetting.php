<?php 
session_start(); 
include "DbConnection.php";
include "AuthenticateMiddleware.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="global.css">
</head>
<body>
    <?php $pageTitle = "Account Setting"; include "TopBar.php" ?>
    <?php include "SideBar.php" ?>

    <div class="page-content">
        <?php 
            $selfId = $_SESSION["authId"];
            $query = "SELECT * FROM users WHERE userId = $selfId";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_array($result)) {
        ?>
        <form action="#" method="post">
            <label for="formUserName">Username:</label>
            <input type="text" name="formUserName" id="formUserName" placeholder="Name" value="<?php echo $row[1] ?>">

            <label for="formEmail">Email:</label>
            <input type="text" name="formEmail" id="formEmail" placeholder="Sample@gmail.com" value="<?php echo $row[4] ?>">

            <label for="formPassword">Password:</label>
            <input type="password" name="formPassword" id="formPassword" placeholder="Passw0rd123" value="<?php echo $row[2] ?>">
            <input type="hidden" name="formUserId" value="<?php echo $_SESSION["authId"] ?>">
            <input type="submit" name="submit" value="submit"> <br><br><br>
            <?php if (isset($_GET["formMessage"])) {
                ?>
                    <span class="formMessage"><?php echo $_GET["formMessage"] ?></span>
                <?php
            } ?>
        </form>
        <?php } ?>
    </div>
</body>
</html>

<?php 
    if (isset($_POST["submit"]))
            {
                $selfId = $_POST["formUserId"];
                $userName = $_POST["formUserName"];
                $email = $_POST["formEmail"];
                $password = $_POST["formPassword"];
                
                $query = "UPDATE users SET email = '$email', username = '$userName', password = '$password' WHERE userId = $selfId";
                mysqli_query($connection, $query);
                echo "<script>location.replace(window.location.protocol + '//' + window.location.host + window.location.pathname + '?formMessage=Successfully%20Updated%20Account%20Info')</script>";
            }
?>

<style>
    .page-content {
        padding: 100px 200px;
    }
</style>