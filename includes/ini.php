<?php

$dsn = "mysql:host=localhost:3308;dbname=thaifooddb";
$dBUsername = "root";
$dBPassword = "";

$conn = new PDO($dsn, $dBUsername, $dBPassword);
// Throws a PDOException if the attribute PDO::ATTR_ERRMODE is set to PDO::ERRMODE_EXCEPTION.
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
