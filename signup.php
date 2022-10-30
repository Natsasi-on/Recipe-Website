<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
$nameErrorMsg = $emptyError = $pwdErrorMsg = $conpwdErrorMsg = $postalCodeErrorMsg = $phoneErrorMsg = $emailErrorMsg =  "";
$name = $password = $confirmPassword = $postalCode = $PhoneNum = $EmailAddress = "";
$sPhone = $sEmail = $sMorning = $sAfternoon = $sEvening = '';

if (isset($_SESSION["sessionName"])) {
    $name = $_SESSION["sessionName"];
}
if (isset($_SESSION["sessionPwd"])) {
    $password = $_SESSION["sessionPwd"];
}
if (isset($_SESSION["sessionConPwd"])) {
    $confirmPassword = $_SESSION["sessionConPwd"];
}
if (isset($_SESSION["sessionPostalCode"])) {
    $postalCode = $_SESSION["sessionPostalCode"];
}
if (isset($_SESSION["sessionPhoneNum"])) {
    $PhoneNum = $_SESSION["sessionPhoneNum"];
}
if (isset($_SESSION["sessionEmailAddress"])) {
    $EmailAddress = $_SESSION["sessionEmailAddress"];
}


if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyinput") {
        $emptyError = "Fill in all field!!!!!!";
    } elseif ($_GET["error"] == "invalidUid") {
        $emptyError = "The error is shown below!";
        $nameErrorMsg = "Name shouldn't contain number";
    } elseif ($_GET["error"] == "invalidconfirmPassword") {
        $emptyError = "The error is shown below!";
        $pwdErrorMsg = "A password should have at least 8 characters, including at least 1 capital letter, 1 lowercase letter, 1 special character, and 1 number.";
    } elseif ($_GET["error"] == "invalidPassword") {
        $emptyError = "The error is shown below!";
        $conpwdErrorMsg = "Password not match";
    } elseif ($_GET["error"] == "invalidpostalCode") {
        $emptyError = "The error is shown below!";
        $postalCodeErrorMsg = "Use Canadien postcode";
    } elseif ($_GET["error"] == "invalidPhoneNum") {
        $emptyError = "The error is shown below!";
        $phoneErrorMsg = "Use Canadien phone number";
    } elseif ($_GET["error"] == "invalidEmailAddress") {
        $emptyError = "The error is shown below!";
        $emailErrorMsg = "Invalid Email Address";
    } elseif ($_GET["error"] == "emailExists") {
        $emptyError = "The error is shown below!";
        $emailErrorMsg = "This email is already used";
    } elseif ($_GET["error"] == "stmtfailed") {
        $emptyError = "Something went wrong, try again!";
    } elseif ($_GET["error"] == "none") {
        $emptyError = "Sign up completed!";
        header("location: loginV2.php");
        exit();
    }
}

include("./Header.php");
?>


<link rel="stylesheet" href="common/css/regist.css">
<br />
<section style="background-image: url(common/images/menu-bg.png);" class="our-menu section bg-light repeat-img" id="menu">
    <div class="sec-wp">
        <div class="container">

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sec-title text-center mb-5">
                            <p class="sec-sub-title mb-3">registration</p>
                            <h2 class="h2-title">Customer Information</span></h2>

                            <div class="sec-title-shape mb-4">
                                <img src="common/images/title-shape.svg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo '<p class="errorMsg"><br>' . $emptyError . '</br></p>' ?>
                <div class="formBox">
                    <form method="post" action="includes/signup.inc.php" name="myform">
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label><b>Name</b></label>
                                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                                <div class="text-danger">
                                    <?php echo $nameErrorMsg; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label><b>Password</b></label>
                                <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
                                <div class="text-danger">
                                    <?php echo $pwdErrorMsg; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label><b>Confirm Password</b></label>
                                <input type="password" class="form-control" name="confirmPassword" value="<?php echo $confirmPassword; ?>">
                                <div class="text-danger">
                                    <?php echo $conpwdErrorMsg; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label><b>Postal Code</b></label>
                                <input type="text" class="form-control" name="postalCode" value="<?php echo $postalCode; ?>">
                                <div class="text-danger">
                                    <?php echo $postalCodeErrorMsg; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label><b>Phone Number</b></label>
                                <input type="text" class="form-control" name="PhoneNum" placeholder="xxx-xxx-xxx" value="<?php echo $PhoneNum; ?>">
                                <div class="text-danger">
                                    <?php echo $phoneErrorMsg; ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label><b>Email Address</b></label>
                                <input type="text" class="form-control" name="EmailAddress" value="<?php echo $EmailAddress; ?>">
                                <div class="text-danger">
                                    <?php echo $emailErrorMsg; ?>
                                </div>
                            </div>
                        </div>
                        <br>
                        <input type='submit' class='sec-btn btn-left' name='btnSigup' value='Submit' />
                    </form>
                </div>
            </div>
        </div>
</section>



<?php

include('./Footer.php'); ?>