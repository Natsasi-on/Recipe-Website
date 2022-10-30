<?php
include("./Header.php");
error_reporting(E_ALL & ~E_NOTICE);
session_start();
$nameErrorMsg = $name = $comment = "";
?>
<link rel="stylesheet" href="common/css/dishPage.css">
<br />
<?php
require_once 'includes/dbh.inc.php';
$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);
if ($conn) {
} else {
    echo 'Error';
}
$foodId = $_GET["foodid"];
$query = "SELECT * FROM recipes WHERE id = $foodId;";
$connect = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($connect);
$num = mysqli_num_rows($connect);

echo '<section class="testimonials section bg-light" style="background-image: url(common/images/blog-pattern-bg.png);">
<div class="sec-wp">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sec-title text-center mb-5">
                    <p class="sec-sub-title mb-3">' . $data["type"] . '</p>
                    <h2 class="h2-title">' . $data["thai_name"] . '</h2>
                    <div class="sec-title-shape mb-4">
                        <img src="common/images/title-shape.svg" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="dish-container">
            <div class="dish-image">
                <img src="' . $data["edited_image"] . '" alt="">
            </div>
            <div class="dish-box-left">
                <h3 class="h3-title">
                    Description
                </h3>
                <p>' . $data["name"] . '</p>
            </div>
            <div class="dish-box-right">
                <h3 class="h3-title">
                    Ingredients
                </h3>
                <ul>
                    <li>' . $data["ingredients"] . '</li>
                </ul>
            </div>
            <div class="dish-box-left">
                <h3 class="h3-title">
                    Cooking Time
                </h3>
                <p>' . $data["cooking_time_hr"] . ' Hour(s)</p>
            </div>
            <div class="dish-box-left">
                <h3 class="h3-title">
                    Serves
                </h3>
                <p>' . $data["max_serve"] . ' people</p>
            </div>
        </div>
    </div>
    <div class="sec-wp">
        <div class="container">
            <div class="dish-step-box">
                <h3 class="h3-title">
                    Step
                </h3>
                <ul>
                    <li>' . $data["step"] . '</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container dish-note">
        <h3 class="h3-title">
            Additional notes:
        </h3>
        <p>' . $data["additional_notes"] . '</p>
    </div>
</div>
</section>';
?>


<section style="background-image: url(assets/images/menu-bg.png);" class="our-menu section bg-light repeat-img" id="menu">
    <div class="sec-wp">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sec-title text-center mb-5">
                            <p class="sec-sub-title mb-3">LEAVE A REPLY</p>
                            <h2 class="h2-title">Comment</span></h2>
                            <div class="sec-title-shape mb-4">
                                <img src="common/images/title-shape.svg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="formBox">
                    <form method="post" action="" name="myform">
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label><b>Comment</b></label>
                                <textarea class="form-control" name="comment" value="<?php echo $comment; ?>"></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label><b>Name</b></label>
                                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                                <div class="text-danger">
                                    <?php echo $nameErrorMsg; ?>
                                </div>
                            </div>
                        </div>
                        <input type='submit' class='sec-btn btn-left' name='btnNext' value='Post Comment' />
                    </form>
                </div>
            </div>
        </div>
</section>


<?php
include('./Footer.php');
