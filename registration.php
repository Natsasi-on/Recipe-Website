<?php
error_reporting(E_ALL & ~E_NOTICE);

session_start();

require_once 'includes/ini.php'; 
require_once './includes/functions.php'; 

// Initialize variables for user registration
$name = $password = $confirmPassword = $email = '';
$nameError = $passwordError = $confirmPasswordError = $emailError = $hashPassword = '';

// Check if the registration form is submitted
if (isset($_POST['btnRegis'])) {

    // Validate the name field
    if (empty($_POST["nametxt"])) {
        $nameError = " Name cannot be blank!";
    } else {
        $name = test_input($_POST["nametxt"]);
        $nameError = ValidateName($name); 
    }

    // Validate the password field
    if (empty($_POST["password"])) {
        $passwordError = " Password cannot be blank!";
    } else {
        $password = test_input($_POST["password"]);
        $passwordError = ValidatePassword($password); 
    }

    // Validate the confirm password field
    if (empty($_POST["confirmPassword"])) {
        $confirmPasswordError = " Cannot be blank!";
    } else {
        $confirmPassword = test_input($_POST["confirmPassword"]);
        $confirmPasswordError = ValidateConfirmPassword($confirmPassword);
    }

    // Validate the email field
    if (empty($_POST["email"])) {
        $emailError = " Email Address cannot be blank!";
    } else {
        $email = test_input($_POST["email"]);
        $emailError = ValidateEmail($email); 

        if ($emailError == '') {
            $emailExists = emailExist($conn, $email); 
            if ($emailExists == false) {
                $emailError = '';
            } else {
                $emailError = 'This email address is already in use!';
            }
        }
    }

    // If all input fields are valid, create a new user
    if (($nameError == '') && ($passwordError == '') && ($confirmPasswordError == '') && ($emailError == '')) {
        //$postalCode = 'K2C 0B6';
        //$PhoneNum = 1234567896;
        
        // Create a new user in the database
        createUser($name, $password, $postalCode, $PhoneNum, $email);
        
        // Store email and password in session for login
        $_SESSION["loginEmail"] = $email;
        $_SESSION["loginPassword"] = $password;

        // Redirect to the login page
        header("Location: login.php");
        exit();
    }
}

include("./common/head.php");
?>
<link rel="stylesheet" href="common/styles/registrationn.css">

<section style="background-image: url(common/images/body-bg1.png);">
    <div class="title-box">
        <p class="sh-header-p">Registration</p>
        <h2 class="h2-title">Sign Up</span></h2>
        <br>
    </div>
    <div class="formBox">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="myform">
            <label for="name"><b>Full Name : </b></label>
            <span class="text-error">*<?php echo $nameError; ?></span><br>
            <input type="text" name="nametxt" id="name" value="<?php echo $name; ?>">

            <label for="password"><b>Password : </b></label>
            <span class="text-error">*<?php echo $passwordError; ?></span><br>
            <input type="password" name="password" id="password" value="<?php echo $password; ?>">

            <label for="confirmPassword"><b>Confirm Password : </b></label>
            <span class="text-error">*<?php echo $confirmPasswordError; ?></span><br>
            <input type="password" name="confirmPassword" id="confirmPassword" value="<?php echo $confirmPassword; ?>">

            <label for="email"><b>Email : </b></label>
            <span class="text-error">*<?php echo $emailError; ?></span><br>
            <input type="text" name="email" id="email" value="<?php echo $email; ?>">

            <div class="btn-box">
                <input type='submit' class='my-btn' name='btnRegis' value='Submit' />
            </div>
        </form>
    </div>
</section>

<?php
include('./common/footer.php');
?>
