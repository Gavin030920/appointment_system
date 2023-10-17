<?php 
include "dbConnection.php";

$serviceHistoryId = $_GET["serviceHistoryId"];
$query = "DELETE FROM servicehistories WHERE serviceHistoryId = $serviceHistoryId";
mysqli_query($connection, $query);
echo "The record has been removed from the database.";