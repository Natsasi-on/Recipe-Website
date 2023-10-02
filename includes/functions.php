<?php
// Include the necessary configuration file
include 'includes/ini.php';

// Function to display star ratings based on the starRate parameter
function getStarRating($starRate)
{
    // Switch statement to determine the star rating and display corresponding stars
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

// Function for trimming input data
function test_input($myInput)
{
    $myInput = trim($myInput);
    return $myInput;
}

// Function to validate the name
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

// Function to validate the password
function ValidatePassword($password)
{
    $passwordRegex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/";
    if (preg_match($passwordRegex, $password)) {
        $passwordError = '';
        return $passwordError;
    } else {
        $passwordError = " Password should contain at least 6 characters long, one upper case, one lowercase, and one digit!";
        return $passwordError;
    }
}

// Function to validate the confirmation of the password
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

// Function to validate the email address
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

// Function to create a new user
function createUser($name, $password, $postalCode, $PhoneNum, $email)
{
    // Include the database connection
    include 'includes/ini.php';
    
    // SQL query to insert user data into the database
    $sql = "INSERT INTO users (usersName, usersPwd, usersPost, usersPhone, usersEmail) VALUES (:uName,:uPwd,:uPost,:uPhone,:uEmail);";
    
    // Prepare and execute the SQL statement
    $stmt = $conn->prepare($sql);
    
    // Hash the password for security
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    
    // Execute the query with provided values
    $stmt->execute([
        ':uName' => $name,
        ':uPwd' => $hashedPwd,
        ':uPost' => $postalCode,
        ':uPhone' => $PhoneNum,
        ':uEmail' => $email
    ]);
}

// Function to check if an email already exists in the database
function emailExist($conn, $email)
{
    // Include the database connection
    include 'includes/ini.php';
    
    // SQL query to select a user by email
    $sql = "SELECT * FROM users WHERE usersEmail=:email;";
    
    // Prepare and execute the SQL statement
    $stmt = $conn->prepare($sql);
    $stmt->execute([':email' => $email]);
    
    // Fetch the results
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Check if the result is empty (email doesn't exist)
    if (empty($result)) {
        $myresults = false;
        return $myresults;
    } else {
        return $result;
    }
}

// Function to check if a user with the same email already exists
function userExist($conn, $email)
{
    // Include the database connection
    include 'includes/ini.php';
    
    // SQL query to select a user by email
    $sql = "SELECT * FROM users WHERE usersEmail=:email;";
    
    // Prepare and execute the SQL statement
    $stmt = $conn->prepare($sql);
    $stmt->execute([':email' => $email]);
    
    // Retrieve only one row (there should be only one user with the same email)
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Check if the result is empty (user doesn't exist)
    if (empty($result)) {
        $myresults = false;
        return $myresults;
    } else {
        return $result;
    }
}
