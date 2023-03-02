<?php
include 'includes/ini.php';

function getStarRating($starRate)
{
    switch ($starRate) {
        case 0:
            for ($i = 0; $i < 5; $i++) {
                echo '<img src="common/images/star-empty.svg" alt="star">';
            }
            break;
        case 1:
            echo '<img src="common/images/star-filled.svg" alt="star">';
            for ($i = 0; $i < 4; $i++) {
                echo '<img src="common/images/star-empty.svg" alt="star">';
            }
            break;
        case 2:
            echo '<img src="common/images/star-filled.svg" alt="star">';
            echo '<img src="common/images/star-filled.svg" alt="star">';
            for ($i = 0; $i < 3; $i++) {
                echo '<img src="common/images/star-empty.svg" alt="star">';
            }
            break;
        case 3:
            for ($i = 0; $i < 3; $i++) {
                echo '<img src="common/images/star-filled.svg" alt="star">';
            }
            echo '<img src="common/images/star-empty.svg" alt="star">';
            echo '<img src="common/images/star-empty.svg" alt="star">';
            break;
        case 4:
            for ($i = 0; $i < 4; $i++) {
                echo '<img src="common/images/star-filled.svg" alt="star">';
            }
            echo '<img src="common/images/star-empty.svg" alt="star">';
            break;
        case 5:
            for ($i = 0; $i < 5; $i++) {
                echo '<img src="common/images/star-filled.svg" alt="star">';
            }
            break;
        default:
            echo "Error, unrecognized action: $starRate";
    }
    return null;
}

// fuction for registration new user/////////////////////////////////////////////
function test_input($myInput)
{
    $myInput = trim($myInput);
    return $myInput;
}

function ValidateName($name)
{
    $nameRegex = "/^([a-zA-Z]{2,}\s[a-zA-Z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)/";
    if (preg_match($nameRegex, $name)) {
        $nameError = '';
        return $nameError;
    } else {
        $nameError = ' Should contain first name and last name';
        return $nameError;
    }
}
function ValidatePassword($password)
{
    $passwordRegex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/";
    if (preg_match($passwordRegex, $password)) {
        $passwordError = '';
        return $passwordError;
    } else {
        $passwordError = " Password should contain at least 6 characters long, one upper case, one lowercase and one digit!";
        return $passwordError;
    }
    // $passwordError = '';
    // return $passwordError;
}

function ValidateConfirmPassword($confirmPassword)
{
    if ($_POST["password"] != $_POST["confirmPassword"]) {
        $confirmPasswordError = " Password does not match!";
        return $confirmPasswordError;
    } else {
        $confirmPasswordError = '';
        return $confirmPasswordError;
    }
}
function ValidateEmail($email)
{
    $EmailAddressRegex = "/\b[a-zA-Z0-9._%+-]+@(([a-zA-Z0-9-]+)\.)+[a-zA-Z]{2,4}\b/";
    if (preg_match($EmailAddressRegex, $email)) {
        $emailError = '';
        return $emailError;
    } else {
        $emailError = " Invalid Email Address";
        return $emailError;
    }
}
///////////////////////////////////////////////////////////////////
function createUser($name, $password, $postalCode, $PhoneNum, $email)
{
    include 'includes/ini.php';
    $sql = "INSERT INTO users (usersName, usersPwd, usersPost, usersPhone, usersEmail) VALUES (:uName,:uPwd,:uPost,:uPhone,:uEmail);";
    $stmt = $conn->prepare($sql);
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    $stmt->execute([':uName' => $name, ':uPwd' => $hashedPwd, ':uPost' => $postalCode, ':uPhone' => $PhoneNum, ':uEmail' => $email]);
}
///////////////////////////////////////////////
function emailExist($conn, $email)
{
    include 'includes/ini.php';
    $sql = "SELECT * FROM users WHERE usersEmail=:email;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':email' => $email]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (empty($result)) {
        $myresults = false;
        return $myresults;
    } else {
        return $result;
    }
}
function userExist($conn, $email)
{
    include 'includes/ini.php';
    $sql = "SELECT * FROM users WHERE usersEmail=:email;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':email' => $email]);
    //retrieve only one row foreach doesn't require
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (empty($result)) {
        $myresults = false;
        return $myresults;
    } else {
        return $result;
    }
}
