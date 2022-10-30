<?php

if (isset($_POST["btnLogin"])) {
    $EmailAddress = $_POST["EmailAddress"];
    $password = $_POST["password"];

    require_once 'dbh.inc.php';
    require_once 'function.inc.php';

    if (emptyInputLogin($EmailAddress, $password !== false)) {
        header("location: ../loginV2.php?error=emptyInput");
        exit();
    }
    loginUser($conn, $EmailAddress, $password);
} else {
    header("location: ../loginV2.php");
    exit();
}
