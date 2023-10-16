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
<body style="margin: 0;">
    <?php $pageTitle = "Service Suggestion"; include "TopBar.php" ?>
    <?php include "SideBar.php" ?>

    <div class="page-content">
        <div class="items-container">
            <?php 
                $retrieveServicesQuery = "SELECT * FROM services JOIN users ON services.repairmanId = users.userId";
                $result = mysqli_query($connection, $retrieveServicesQuery);
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <div class="item">
                            <center>
                                <a href="CreateUpdateAppointment.php?serviceId=<?php echo $row["serviceId"] ?>">
                                    <img class="item-image" src="Assets/ServiceLogo.png" alt="service_logo.png">
                                </a>
                            </center>
                                <span><?php echo $row["serviceName"] ?></span>
                                <a class="service-repairman-name" href="ChattingPage.php?userId=<?php echo $row["userId"] ?>">
                                    <span>
                                        <?php echo $row["username"] ?>
                                    </span>
                                </a>
                        </div>
                    <?php
                }
            ?>
        </div>
    </div>
</body>
</html>


<style>
.item {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    box-shadow: 0 3px 10px #0000000D;
}

.item:hover {
    cursor: pointer;
}

.items-container {
    display: grid;
    grid-template-columns: repeat(4, auto);
    gap: 20px;
    padding: 20px;
    background-color: #f7f7f7;
}

.item-image {
    height: 100px;
    width: 100px;
    border-radius: 50%;
    margin-bottom: 15px;
}

.service-repairman-name:hover {
    font-weight: bolder;
}
</style>