<?php

$dbServerName = "localhost";
$dbUsername = "root";
$dbPassword = "root";
$dbName = "demo";
$dbPort = 3308;

$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName, $dbPort);

if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
    }

?>
