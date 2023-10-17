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
    <link href='https://fonts.googleapis.com/css?family=Roboto Mono' rel='stylesheet'>
</head>
<body>
    <?php $pageTitle = "Billing Detail"; include "TopBar.php" ?>
    <?php include "SideBar.php" ?>
    <?php
        if (isset($_GET["invoiceId"])) {
            $userId = $_SESSION["authId"];
            $invoiceId = $_GET["invoiceId"];
            $query = "SELECT sh.serviceEventTitle, sh.servicingDate, 
                                uR.username as RepairmanName,
                                uC.username as CustomerName,
                                aI.businessAddress,
                                i.invoiceId, i.invoiceDate, i.status, i.totalAmount
                           FROM invoices i
                           LEFT JOIN serviceHistories sh ON i.serviceHistoryId = sh.serviceHistoryId
                           LEFT JOIN users uR ON sh.repairmanId = uR.userId
                           LEFT JOIN users uC ON sh.customerId = uC.userId
                           LEFT JOIN accountInformations aI ON uR.userId = aI.userId
                           WHERE i.customerId = '$userId' AND i.invoiceId = $invoiceId";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="page-content">
                        <div class="header">
                            Invoice
                        </div> <br><br><br>
                        <div class="subheader">
                            Invoice Id. <?php echo $row["invoiceId"] ?>
                        </div>
                        <div class="subheader">
                            Invoice Date. <?php echo $row["invoiceDate"] ?>
                        </div>
                        <div class="merchant-content">
                            <div class="merchant-content-list">
                                <div class="merchant-name"><?php echo $row["RepairmanName"] ?></div>
                                <div class="merchant-address">
                                    <?php
                                        foreach (explode(",", $row["businessAddress"]) as $line) {
                                            ?>
                                                <div class="merchantAddressLine"><?php echo $line ?></div>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="customer-content">
                            <div class="customer-name"><?php echo $row["CustomerName"] ?></div>
                        </div>
                        
                        <br><br>
                        <span class="subheader">BILL SUMMARY</span> 
                        <br><br>
                        <hr>

                        <div class="billing-detail">
                            <span class="billing-line"><?php echo $row["serviceEventTitle"] ?></span>
                            <span class="billing-line"><?php echo "RM " . number_format($row["totalAmount"], 2) ?></span>
                        </div>
                        <div class="billing-detail">
                            <span class="billing-line">Total Amount (Net).</span>
                            <span class="billing-line"><?php echo "RM " . number_format($row["totalAmount"], 2) ?></span>
                        </div>
                    </div>
                <?php
            }
        }
    ?>
</body>
</html>


<style>
    body {
        background-color: white;
    }
    .page-content {
        padding: 40px !important;
    }
    .header {
        font-size: 50px;
        font-weight: bold;
    }
    .subheader {
        font-size: 30px;
    }
    .billing-line {
        font-weight: bold;
        font-size: 20px;
        margin-top: 20px;
    }
    .merchant-content {
        display: flex;
        justify-content: end;
    }
    .merchant-content-list {
        display: flex;
        flex-direction: column;
    }
    .merchantAddressLine {
        text-align: end;
        font-size: 20px;
    }
    .merchant-name {
        font-size: 30px;
        text-align: end;
        margin-bottom: 20px;
    }
    .customer-name {
        font-size: 30px;
    }
    .billing-detail {
        display: flex;
        justify-content: space-between;
    }
</style>