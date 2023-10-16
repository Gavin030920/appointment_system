<?php
include "DbConnection.php";

function redirectUserBackToLogin() {
    session_destroy();
    echo "<script>location.replace('../login/Login.php');</script>";
}

if (!isset($_SESSION["authId"]) ||
        !isset($_SESSION["token"])) {
            redirectUserBackToLogin();
        }
        else 
        {
            $userId = $_SESSION["authId"];
            $token = $_SESSION["token"];
            $query = "SELECT * FROM users WHERE token = '$token' AND userId = '$userId'";
            $result = mysqli_query($connection, $query);

            if (mysqli_num_rows($result) == 0) {
                redirectUserBackToLogin();
            }
        }
