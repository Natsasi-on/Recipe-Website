<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "thaifooddb";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

//check if fail
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
