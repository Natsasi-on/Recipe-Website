<?php
session_start();
if (isset($_POST["btnSigup"])) {
    $name = $_POST["name"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $postalCode = $_POST["postalCode"];
    $PhoneNum = $_POST["PhoneNum"];
    $EmailAddress = $_POST["EmailAddress"];

    $_SESSION["sessionName"] = $name;
    $_SESSION["sessionPostalCode"] = $postalCode;
    $_SESSION["sessionPhoneNum"] = $PhoneNum;
    $_SESSION["sessionEmailAddress"] = $EmailAddress;
    $_SESSION["sessionPwd"] = $password;
    $_SESSION["sessionConPwd"] = $confirmPassword;

    require_once 'dbh.inc.php';
    require_once 'function.inc.php';

    if (emptyInputSignup($name, $password, $confirmPassword, $postalCode, $PhoneNum, $EmailAddress) !== false) {
        //มีว่างไหม ถ้ามี ทำนี่
        //ส่งบอกว่ามีerror ใน url
        header("location: ../signup.php?error=emptyinput");
        exit();
    }

    if (invalidUid($name) !== false) {
        header("location: ../signup.php?error=invalidUid");
        exit();
    }
    if (invalidPassword($password) !== false) {

        header("location: ../signup.php?error=invalidPassword");
        exit();
    }
    if (invalidconfirmPassword($password, $confirmPassword) !== false) {

        header("location: ../signup.php?error=invalidconfirmPassword");
        exit();
    }
    if (invalidpostalCode($postalCode) !== false) {

        header("location: ../signup.php?error=invalidpostalCode");
        exit();
    }
    if (invalidPhoneNum($PhoneNum) !== false) {

        header("location: ../signup.php?error=invalidPhoneNum");
        exit();
    }
    if (invalidEmailAddress($EmailAddress) !== false) {

        header("location: ../signup.php?error=invalidEmailAddress");
        exit();
    }
    //check ว่ามีuser ใน db เเล้ว
    if (emailExists($conn, $EmailAddress) !== false) {

        header("location: ../signup.php?error=emailExists");
        exit();
    }

    createUser($conn, $name, $password, $postalCode, $PhoneNum, $EmailAddress);
} else {
    header("location: ../signup.php");
    exit();
}
