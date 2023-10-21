<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <h1>Edit Service History</h1>
    <?php
    include "dbConnection.php";

    // Check if the serviceHistoryId is provided in the URL
    if (isset($_GET["serviceHistoryId"])) {
        $serviceHistoryId = $_GET["serviceHistoryId"];
        
        // Retrieve the service history record based on the serviceHistoryId
        $query = "SELECT * FROM servicehistories WHERE serviceHistoryId = $serviceHistoryId";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // Display a form to edit the Service Event and Total Amount
            echo "<form method='post' action='updateServiceEvent.php'>";
            echo "<input type='hidden' name='serviceHistoryId' value='$serviceHistoryId'>";
            echo "Service Event: <input type='text' name='newServiceEventTitle' value='" . $row['serviceEventTitle'] . "'>";
            echo "Total Amount: <input type='text' name='newTotalAmount' value='" . $row['totalAmount'] . "'>";
            echo "<button type='submit'>Update</button>";
            echo "</form>";
        } else {
            echo "Service history record not found.";
        }
    } else {
        echo "Service history ID not provided in the URL.";
    }
    ?>
</body>
</html>