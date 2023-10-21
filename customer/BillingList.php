<?php
session_start();
ob_start(); // buffering before sending to client
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
    <?php $pageTitle = "Billing List"; include "TopBar.php" ?>
    <?php include "SideBar.php" ?>
    <div class="page-content">
        <div class="row-header">
            <form action="#" method="post">
                <input type="hidden" name="IsPopupInvoiceVisible" value="true">
                <input class="view-invoice" type="submit" name="popupVisibilitySubmit" value="View Invoice">
            </form>
            <form action="#" method="post">
                <input type="hidden" name="generateBill" value="true">
                <input type="hidden" name="formUserId" value="<?php echo $_SESSION["authId"] ?>">
                <input class="pay-now" type="submit" type="submit" name="generateBillSubmit" value="Create Payment Invoice">
            </form>
        </div>
        <div class="card-listing">
            <?php
                    $userId = $_SESSION["authId"];
                    $query = "SELECT sh.serviceEventTitle, i.status, i.invoiceId,
                                     sh.servicingDate, uR.username as RepairmanName, 
                                     uC.username as CustomerName, i.totalAmount 
                                FROM invoices i
                                JOIN serviceHistories sh ON i.serviceHistoryId = sh.serviceHistoryId
                                JOIN users uR ON sh.repairmanId = uR.userId
                                JOIN users uC ON sh.customerId = uC.userId
                                WHERE i.customerId = '$userId'";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <a href="BillingDetail.php?invoiceId=<?php echo $row["invoiceId"] ?>">
                            <div class="card">
                                <div class="card-header">
                                    <span class="header">Type of Service:  <?php echo $row["serviceEventTitle"] ?></span>
                                    <span class="header">Payment Status: <?php echo $row["status"] ?></span>
                                </div>
                                <span>Servicing date and time: <?php echo $row["servicingDate"] ?></span>
                                <span>Merchant: <?php echo $row["RepairmanName"] ?></span>
                                <span>Total Payment: <?php echo "RM " . number_format($row["totalAmount"], 2) ?></span>
                            </div>
                        </a>
                        <?php
                    }
            ?>
        </div>
    </div>

    <?php 
        if (isset($_POST["popupVisibilitySubmit"]) && $_POST["IsPopupInvoiceVisible"] == "true") {
            ?>
                <div class="popup-view-invoice">
                    <div class="popup-header">
                        <form action="#" method="post">
                            <input type="hidden" name="IsPopupInvoiceVisible" value="false">
                            <input class="popup-close-btn" type="submit" name="popupVisibilitySubmit" value="X">
                        </form>
                    </div>
                    <div class="unpaid-invoice-header justify-align-center">
                        <span class="bold-text">Unpaid Bills</span>
                    </div>
                    <div class="unpaid-invoice-list">
                        <?php 
                                $userId = $_SESSION["authId"];
                                $query = "SELECT * FROM invoices i
                                            JOIN serviceHistories sh ON i.serviceHistoryId = sh.serviceHistoryId
                                            WHERE i.customerId = '$userId' AND i.status = 'pending'";
                                $results = mysqli_query($connection, $query);
                                while ($row = mysqli_fetch_array($results)) {
                                    ?>
                                        <a href="BillingDetail.php?invoiceId=<?php echo $row["invoiceId"] ?>">
                                            <div class="invoice-item">
                                                <?php echo "Type of service: " . $row["serviceEventTitle"] ?> <br>
                                                <?php echo "Total Amount: RM " . $row["totalAmount"] ?> <br>
                                                <?php echo "Servicing date: " . $row["servicingDate"] ?> <br>
                                                <?php echo "Due date: " . $row["dueDate"] ?>
                                            </div>
                                        </a>
                                    <?php
                                }
                            ?>
                        </div>
                    <div class="paid-invoice-header justify-align-center">
                        <span class="bold-text">Paid Bills</span>
                    </div>
                    <div class="paid-invoice-list">
                        <?php 
                            $userId = $_SESSION["authId"];
                            $query = "SELECT * FROM invoices i
                                        JOIN serviceHistories sh ON i.serviceHistoryId = sh.serviceHistoryId
                                        WHERE i.customerId = '$userId' AND i.status = 'paid'";
                            $results = mysqli_query($connection, $query);
                            while ($row = mysqli_fetch_array($results)) {
                                ?>
                                    <a href="BillingDetail.php?invoiceId=<?php echo $row["invoiceId"] ?>">
                                        <div class="invoice-item">
                                            <?php echo "Type of service: " . $row["serviceEventTitle"] ?> <br>
                                            <?php echo "Total Amount: RM " . $row["totalAmount"] ?> <br>
                                            <?php echo "Servicing date: " . $row["servicingDate"] ?> <br>
                                            <?php echo "Due date: " . $row["dueDate"] ?>
                                        </div>
                                    </a>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            <?php
        }
    ?>
</body>
</html>

<?php
    if (isset($_POST["generateBillSubmit"])) {
        $customerId = $_POST["formUserId"];
        $unpaidServiceHistory = "SELECT sh.serviceHistoryId, sh.repairmanId, sh.serviceId, sh.totalAmount, 
                                        i.invoiceId, i.status
                                    FROM serviceHistories sh
                                    LEFT JOIN invoices i ON i.serviceHistoryId = sh.serviceHistoryId
                                    WHERE (i.status = 'pending' OR i.status IS NULL)
                                    AND sh.customerId = '$customerId'";
        $result = mysqli_query($connection, $unpaidServiceHistory);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $serviceHistoryId = $row["serviceHistoryId"];
                $repairmanId = $row["repairmanId"];
                $serviceId = $row["serviceId"];
                $dateTimeNow = date("Y-m-d H:i:s");
                $dueDate = date("Y-m-d H:i:s", strtotime($dateTimeNow . '+10 days'));
                $totalAmount = $row["totalAmount"];

                $previousInvoiceId = $row["invoiceId"];
                $deletePreviousUnpaidInvoiceQuery = "DELETE FROM invoices WHERE invoiceId = '$previousInvoiceId'";

                $createInvoiceQuery = "INSERT INTO invoices (repairmanId, customerId, serviceHistoryId, invoiceDate, dueDate, totalAmount, status)
                                        VALUES ('$repairmanId', '$customerId', '$serviceHistoryId', '$dateTimeNow', '$dueDate', '$totalAmount', 'pending')";

                mysqli_query($connection, $deletePreviousUnpaidInvoiceQuery);
                mysqli_query($connection, $createInvoiceQuery);
            }
        }
        header( "Location:" .$_SERVER['REQUEST_URI']);
    }
    ob_end_flush();
?>

<style>
    .popup-view-invoice {
        margin: auto;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        position: absolute;
        z-index: 100;
        width: 500px;
        height: 650px;
        border: 1px solid grey;
        background-color: #001F3F;
    }

    .popup-header {
        display: flex;
        justify-content: end;
        align-items: center;
        height: 50px;
    }

    .popup-close-btn {
        margin-right: 25px;
        background-color: transparent !important;
        border: none !important;
    }

    .unpaid-invoice-header {
        height: 100px;        
        background-color: #E3E3E3;
        border: 1px solid grey;
    }

    .paid-invoice-header {
        height: 100px;
        background-color: #E3E3E3;
        border: 1px solid grey;
    }

    .justify-align-center {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .bold-text {
        font-size: 2rem;
        font-weight: bold;
    }

    .invoice-item {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100px;
        width: auto;
        border: 1px solid;
        cursor: pointer;
    }

    .unpaid-invoice-list {
        height: 200px;
        background-color: white;
        overflow-y: auto;
    }

    .paid-invoice-list {
        height: 200px;
        background-color: white;
        overflow-y: auto;
    }

    .row-header {
        display: flex;
        justify-content: end;
        margin: 100px 20px 20px 0px; 
        /* TOP LEFT BOTTOM RIGHT */
    }

    .view-invoice {
        margin-right: 40px !important;
        padding: 20px 30px !important;
        background-color: white !important;
        color: black !important;
        border: 1px solid grey !important;
    }

    .pay-now {
        padding: 20px 30px !important;
        background-color: white !important;
        color: black !important;
        border: 1px solid grey !important;
    }

    .card-listing {
        overflow-y: auto;
    }

    .card {
        display: flex;
        flex-direction: column;
        justify-content: center;
        width: auto;
        height: 150px;
        padding: 0px 20px;
        background-color: white;
        margin: 30px 20px;

        border: 1px solid grey;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .header {
        font-weight: bold;
    }
</style>