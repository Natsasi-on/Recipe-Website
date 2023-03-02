<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if (!isset($_SESSION["userNameDB"])) {
    header("Location: login.php");
    exit();
}
include("./common/header.php");
?>


<?php session_destroy();
header("Location: index.php");
exit();
?>

<?php
include('./common/footer.php');
