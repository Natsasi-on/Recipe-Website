<?php
error_reporting(E_ALL & ~E_NOTICE);

// Start a session
session_start();

// Initialize email and password variables
if (!isset($_SESSION["loginEmail"])) {
    $email = '';
    $password = '';
} else {
    $email = $_SESSION["loginEmail"];
    $password = $_SESSION["loginPassword"];
}

$emailError = $loginPwdError = '';

require './includes/ini.php'; 
include './includes/functions.php'; 

// Check if the login form is submitted
if (isset($_POST['btnLogin'])) {
    // Validate the email field
    if (empty($_POST["email"])) {
        $emailError = " Email Address cannot be blank!";
    } else {
        $email = test_input($_POST["email"]);
        $emailError = '';
    }

    // Validate the password field
    if (empty($_POST["password"])) {
        $loginPwdError = " Password cannot be blank!";
    } else {
        $password = test_input($_POST["password"]);
        $loginPwdError = '';
    }

    // If both email and password are valid, proceed with login
    if (($emailError == '') && ($loginPwdError == '')) {
        // Check if the user exists in the database
        $userExists = userExist($conn, $email);

        if ($userExists == false) {
            $emailError = "No email address or password was found!!!";
        } else {
            // Compare the hashed password from the database with the entered password
            $pwdHashed = $userExists["usersPwd"];
            $checkPwd = password_verify($password, $pwdHashed);

            if ($checkPwd === false) {
                $emailError = "Wrong email or password!!";
            } elseif ($checkPwd === true) {
                // Store user data in session variables and redirect to the index page
                $_SESSION["useridfromDB"] = $userExists["usersId"];
                $_SESSION["userEmail"] = $userExists["usersEmail"];
                $_SESSION["userNameDB"] = $userExists["usersName"];
                header("location: index.php");
                exit();
            }
        }
    }
}

include("./common/head.php");
?>
<link rel="stylesheet" href="common/styles/registrationn.css">

<section style="background-image: url(common/images/body-bg1.png);">
    <div class="title-box">
        <p class="sh-header-p">Log In</p>
        <h2 class="h2-title">Sign In</span></h2>
        <br>
    </div>
    <div class="formBox">
        <form method="post" action="" name="myform">
            <label for="email"><b>Email : </b></label>
            <span class="text-error">*<?php echo $emailError; ?></span><br>
            <input type="text" name="email" value="<?php echo $email; ?>">

            <label for="password"><b>Password : </b></label>
            <span class="text-error">*<?php echo $loginPwdError; ?></span><br>
            <input type="password" name="password" value="<?php echo $password; ?>">

            <a href="">Forgot password?</a>

            <div class="btn-box">
                <input type='submit' class='my-btn' name='btnLogin' value='Submit' />
            </div>
        </form>
    </div>
</section>

<?php
// Include the HTML footer section
include('./common/footer.php');
?>
