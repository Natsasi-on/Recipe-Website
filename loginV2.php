<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
$pwdErrorMsg = $emailErrorMsg = $emptyError = "";
$password = $EmailAddress = "";
if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyInput") {
        $emptyError = "Fill in all field!!!!!!";
    } elseif ($_GET["error"] == "wronglogin") {
        $emptyError = "Invalid data!";
    }
}

include("./Header.php");
?>
<link rel="stylesheet" href="common/css/regist.css">
<link rel="stylesheet" href="common/css/login.css">
<br />
<section style="background-image: url(common/images/menu-bg.png);" class="our-menu section bg-light repeat-img" id="menu">
    <div class="sec-wp">
        <div class="container">

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sec-title text-center mb-5">
                            <p class="sec-sub-title mb-3">Log in</p>
                            <h2 class="h2-title">Log in to our system</span></h2>
                            <div class="sec-title-shape mb-4">
                                <img src="common/images/title-shape.svg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo '<p class="errorMsg"><br>' . $emptyError . '</br></p>' ?>
                <div class="formBox">
                    <form method="post" action="includes/login.inc.php" name="myform">
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label><b>Email Address</b></label>
                                <input type="text" class="form-control" name="EmailAddress" value="<?php echo $EmailAddress; ?>">
                                <div class="text-danger">
                                    <?php echo $emailErrorMsg; ?>
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
                        <p class="regisTxt"><a href="">Forgotten Your Password?</a> or <a href="signup.php">Register for a new account</a></p>
                        <br>
                        <input type='submit' class='sec-btn btn-left' name='btnLogin' value='Submit' />
                    </form>
                </div>
            </div>
        </div>
</section>



<?php

include('./Footer.php');
