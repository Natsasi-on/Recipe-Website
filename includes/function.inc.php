<?php

function emptyInputSignup($name, $password, $confirmPassword, $postalCode, $PhoneNum, $EmailAddress)
{
    $result = "";
    if (empty($name) || empty($password) || empty($confirmPassword) || empty($postalCode) || empty($PhoneNum) || empty($EmailAddress)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidUid($name)
{
    $result = "";
    $nameRegex = "/^[a-z ,.'-]+$/i";

    if (!preg_match($nameRegex, $name)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidPassword($password)
{
    $result = "";
    $pwdRegex =  "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/";

    if (!preg_match($pwdRegex, $password)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidconfirmPassword($password, $confirmPassword)
{
    $result = "";
    if ($password !== $confirmPassword) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidpostalCode($postalCode)
{
    $result = "";
    $postRegex = "/\b[a-z][0-9][a-z] ?[0-9][a-z][0-9]\b/i";

    if (!preg_match($postRegex, $postalCode)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function invalidPhoneNum($PhoneNum)
{
    $result = "";
    $phoneRegex = "/\b([2-9][0-9][0-9]-){2}[0-9]{4}\b/";

    if (!preg_match($phoneRegex, $PhoneNum)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidEmailAddress($EmailAddress)
{
    $result = "";
    $emailRegex = "/\b[a-zA-Z0-9._%+-]+@(([a-zA-Z0-9-]+)\.)+[a-zA-Z]{2,4}\b/";

    if (!preg_match($emailRegex, $EmailAddress)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function emailExists($conn, $EmailAddress)
{
    $sql = "SELECT * FROM users WHERE usersEmail=?;";
    //prepare statement ทำให้ input secure
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=emailExists");
        exit();
    }

    //ถ้าไม่fail ส่งข้อมูลลงDB s 1 ัตัวคือส่งไปเเค่อีเมล
    mysqli_stmt_bind_param($stmt, "s", $EmailAddress);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        //ถ้าหาข้อมูลเจอ ส่งไปหน้า login
        return $row;
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $password, $postalCode, $PhoneNum, $EmailAddress)
{
    $sql = "INSERT INTO users (usersName, usersPwd, usersPost, usersPhone, usersEmail) VALUES (?,?,?,?,?);";
    //prepare statement ทำให้ input secure
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    //ทำpassword เป็น code
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    //ถ้าไม่fail ส่งข้อมูลลงDB s 1 ัตัวคือส่งไปเเค่อีเมล
    mysqli_stmt_bind_param($stmt, "sssss", $name, $hashedPwd, $postalCode, $PhoneNum, $EmailAddress);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();
}


function emptyInputLogin($EmailAddress, $password)
{
    $result = "";
    if (empty($password) || empty($EmailAddress)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $EmailAddress, $password)
{ //check email ในตาราง
    $userExists = emailExists($conn, $EmailAddress);

    if ($userExists === false) {
        header("location: ../loginV2.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $userExists["usersPwd"];
    $checkPwd = password_verify($password, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../loginV2.php?error=wronglogin");
        exit();
    } elseif ($checkPwd === true) {
        session_start();
        $_SESSION["useridfromDB"] = $userExists["usersId"];
        $_SESSION["userEmail"] = $userExists["usersEmail"];
        $_SESSION["userNameDB"] = $userExists["usersName"];
        header("location: ../index.php");
        exit();
    }
}
