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
    <?php $pageTitle = "Billing List"; include "TopBar.php" ?>
    <?php include "SideBar.php" ?>
</body>
</html>