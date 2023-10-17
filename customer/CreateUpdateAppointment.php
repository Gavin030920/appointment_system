<?php
session_start();
include "DbConnection.php";
include "AuthenticateMiddleware.php";

$query = "SELECT * FROM services";
$results = mysqli_query($connection, $query);
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
    <?php $pageTitle = "Create Appointment"; include "TopBar.php" ?>
    <?php include "SideBar.php" ?>

    <div class="page-content">
        <form action="#" method="post">
            <label for="formSelectedService">Select Service:</label>
            <select name="formSelectedService" id="formSelectedService"> 
                <?php while ($row = mysqli_fetch_array($results)) {
                    ?>
                        <option value="<?php echo $row[0] ?>" <?php echo isset($_GET["serviceId"]) && $_GET["serviceId"] == $row[0]? "selected" : "" ?>>
                            <?php echo "(" . $row[2] .") Price from RM ". number_format($row[3], 2) ?>
                        </option>
                    <?php
                } ?>
            </select>

            <label for="formAppointmentDate">Appointment Date:</label>
            <input type="datetime-local" name="formAppointmentDate" id="formAppointmentDate" placeholder="Appointment Date">
            <input type="hidden" name="formCustomerId" value="<?php echo $_SESSION["authId"] ?>"> 
            <input type="submit" name="submit" value="Submit"> <br><br><br>
            <?php if (isset($_GET["formMessage"])) {
                ?>
                    <span class="formMessage"><?php echo $_GET["formMessage"] ?></span>
                <?php
            } ?>
        </form>
    </div>
</body>
</html>

<?php 
function refreshBackWithMessage($message) {
    $queryParam = str_replace(" ","%20", $message);
    echo "<script>location.replace(window.location.protocol + '//' + window.location.host + window.location.pathname + '?formMessage=$queryParam')</script>";
    die();
}
    if (isset($_POST["submit"]))
            {
                $serviceId = $_POST["formSelectedService"];
                $appointmentDate = $_POST["formAppointmentDate"];
                $customerId = $_POST["formCustomerId"];

                $retrieveServiceWithRepairman = "SELECT * FROM services 
                                                    JOIN users ON services.repairmanId = users.userId 
                                                    WHERE services.serviceId = $serviceId";
                $retrieveServiceWithRepairmanResult = mysqli_fetch_array(mysqli_query($connection, $retrieveServiceWithRepairman));

                $retrieveUnpaidBill = "SELECT *
                                            FROM serviceHistories sh
                                            LEFT JOIN invoices i ON i.serviceHistoryId = sh.serviceHistoryId
                                            WHERE (i.status = 'pending' OR i.status IS NULL)
                                            AND i.customerId = '$customerId'";
                $retrieveUnpaidBillResult = mysqli_query($connection, $retrieveUnpaidBill);

                if (mysqli_num_rows($retrieveUnpaidBillResult) > 0) {
                    refreshBackWithMessage("You have an unpaid bill, please complete your reoccuring bill to proceed");
                }

                while ($row = $retrieveServiceWithRepairmanResult) {
                    $repairmanId = $row["repairmanId"];
                    $serviceEventTitle = $row["serviceName"];
                    $serviceEventDesc = $row["serviceName"];
                    $servicingPrice = $row["startingPrice"];
                    $tax = 0;
                    $totalAmount = $servicingPrice + $tax;

                    $createAppointmentQuery = "INSERT INTO serviceHistories (serviceId, customerId, repairmanId, serviceEventTitle, serviceEventDescription,
                                                                                servicingDate, price, tax, totalAmount)
                                                VALUES ('$serviceId', '$customerId', '$repairmanId', '$serviceEventTitle', '$serviceEventDesc', '$appointmentDate', '$servicingPrice', '$tax', '$totalAmount')";
                    $isSuccessfullyCreated = mysqli_query($connection, $createAppointmentQuery);
                    break;
                }
                refreshBackWithMessage("Successfully book an appointment");
            }
?>

<style>
    .page-content {
        padding: 100px 200px;
    }
</style>