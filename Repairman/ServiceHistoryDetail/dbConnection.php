<?php
//database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "smallproject";

$connection = mysqli_connect($host, $user, $password, $database);
if (!$connection) {
    die("Connection failed" . mysqli_connect_error());
}

$query = "SELECT * FROM servicehistories WHERE serviceId = 1"; // You can change the condition as needed
$result = mysqli_query($connection, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Error fetching data from the database: " . mysqli_error($connection);
}

?>