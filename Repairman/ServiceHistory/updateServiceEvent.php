<?php
include "dbConnection.php"; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure that the form fields are set before using them
    if (isset($_POST["serviceHistoryId"]) && isset($_POST["newServiceEventTitle"]) && isset($_POST["newTotalAmount"])) {
        $serviceHistoryId = $_POST["serviceHistoryId"];
        $newServiceEventTitle = $_POST["newServiceEventTitle"];
        $newTotalAmount = $_POST["newTotalAmount"];

        // Update the Service Event and Total Amount
        $query = "UPDATE servicehistories
                  SET 
                    serviceEventTitle = '$newServiceEventTitle',
                    serviceEventDescription = '$newServiceEventTitle',
                    price = '$newTotalAmount',
                    totalAmount = '$newTotalAmount'
                  WHERE serviceHistoryId = $serviceHistoryId";

        if (mysqli_query($connection, $query)) {
            echo "Record has been updated successfully!";
        } else {
            echo "Error updating record: " . mysqli_error($connection);
        }
    } else {
        echo "Form fields are not set.";
    }
}
?>
