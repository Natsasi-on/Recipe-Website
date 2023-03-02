<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once 'includes/ini.php';
include_once 'includes/functions.php';
session_start();
if (!isset($_GET["foodid"])) {
    $foodId = NULL;
} else {
    $foodId = $_GET["foodid"];
}

// after submit comment the url will restore to dish without foodid
if ($foodId == NULL) {
    $foodId = $_SESSION['foodId'];
} else {
    unset($_SESSION['foodId']);
    $_SESSION['foodId'] = $foodId;
}

if (!isset($_SESSION["useridfromDB"])) {
    $userId = '';
} else {
    $userId = $_SESSION["useridfromDB"];
}

$commentError = $comment = $ratingError = $thestarRating = '';

if (isset($_POST['btnAddComment'])) {

    if (!isset($_SESSION["userNameDB"])) {
        header("Location: login.php");
        exit();
    } else {
        if (($_POST["starRateDDl"]) == 0) {
            $ratingError = "Please select at least one";
        }
        if (empty($_POST["commenttxt"])) {
            $commentError = 'Cannot be blank!';
        }

        if (($ratingError == '') && ($commentError == '')) {
            $comment = $_POST["commenttxt"];
            $thestarRating = $_POST["starRateDDl"];
            try {
                $sql = "INSERT INTO comment (dish_id, comment, author_id, dish_rating) VALUES (:cDish,:cComment,:cAuthor,:cRating);";
                $stmt = $conn->prepare($sql);
                $stmt->execute([':cDish' => $foodId, ':cComment' => $comment, ':cAuthor' => $userId, ':cRating' => $thestarRating]);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
}



include("./common/head.php");
?>
<link rel="stylesheet" href="common/styles/dish.css">
<section class="">
    <?php
    try {
        $sql = "SELECT * FROM recipes WHERE id = :foodid;";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':foodid' => $foodId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            echo '
    <p class="sh-header-p">' . $row["type"] . '</p>
    <h2 class="h2-title">' . $row["thai_name"] . '</span></h2>
    <br>
    <div class="dish-container">
        <div class="dish-image">
            <img src="' . $row["edited_image"] . '" alt="' . $row["thai_name"] . '">
        </div>
        <div class="dish-box-left">
            <h3 class="h3-title">
                Description
            </h3>
            <p class="body">' . $row["description"] . '</p>
        </div>
        <div class="dish-box-right">
            <h3 class="h3-title">
                Ingredients
            </h3>
            <ul>
                <li class="body">' . $row["ingredients"] . '</li>
            </ul>
        </div>
        <div class="dish-box-left">
            <h3 class="h3-title">
                Cooking Time
            </h3>
            <p>' . $row["cooking_time_hr"] . ' Hour(s)</p>
        </div>
        <div class="dish-box-left">
            <h3 class="h3-title">
                Serves
            </h3>
            <p>' . $row["max_serve"] . ' people</p>
        </div>
    </div>
    <div class="dish-step-box">
        <h3 class="h3-title">
            Step
        </h3>
        <ul>
            <li class="body">' . $row["step"] . '</li>
        </ul>
    </div>

    <div class="dish-note">
        <h3 class="h3-title">
            Additional notes :
        </h3>
        <p class="body">' . $row["additional_notes"] . '</p>
    </div>
      ';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    ?>
</section>

<!-- comment -->
<section style="background-image: url(common/images/body-bg1.png);">
    <div class="">
        <p class="sh-header-p">Leave A Reply</p>
        <h2 class="h2-title">Comment</span></h2>
        <br>
    </div>
    <div class="review-box flex-row">
        <div class="sum-review ">
            <?php
            try {
                $sql = "SELECT *,COUNT(comment_id) AS num_comment, CAST(AVG(dish_rating)AS DECIMAL(5, 1)) AS overall_rate, ROUND(AVG(dish_rating), 0) AS round_rate FROM comment WHERE dish_id = :foodid;";
                $stmt = $conn->prepare($sql);
                $stmt->execute([':foodid' => $foodId]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    $starRate = $row["round_rate"];
                    echo '
                    <h6>' . $row["overall_rate"] . '/5</h6>
                    <div class="dish-rating">';
                    getStarRating($starRate);
                    echo '
                    </div>
                    <h6>' . $row["num_comment"] . ' reviews</h6>
                    ';
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="myform" class="formBox">
            <label for="comment"><b>Comment : </b></label><span class="text-error">*<?php echo $commentError; ?></span><br>
            <textarea class="form-control" name="commenttxt" id="comment" value="<?php echo $comment; ?>"></textarea>
            <!-- <div class="dish-rating">
                <img src="common/images/star-empty.svg" alt="star-image">
                <img src="common/images/star-empty.svg" alt="star-image">
                <img src="common/images/star-empty.svg" alt="star-image">
                <img src="common/images/star-empty.svg" alt="star-image">
                <img src="common/images/star-empty.svg" alt="star-image">
            </div> -->
            <label for="star-rate">Choose rating:</label>
            <select name="starRateDDl" id="star-rate">
                <option value=0> Select ... </option>
                <option value=1>1 star</option>
                <option value=2>2 stars</option>
                <option value=3>3 stars</option>
                <option value=4>4 stars</option>
                <option value=5>5 stars</option>
            </select><span class="text-error"> *<?php echo $ratingError; ?></span>
            <div class="btn-box">
                <input type='submit' class='my-btn' name='btnAddComment' value='Submit' />
            </div>
        </form>
    </div>
</section>

<!-- all comment section -->
<section class="all-comment-section">
    <?php
    try {
        $sql = "SELECT * FROM `comment` INNER JOIN users ON comment.author_id = users.usersId WHERE dish_id = :foodid;";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':foodid' => $foodId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $starRate = $row["dish_rating"];
            echo '
    <div class="box-comment">
        <div class="dish-rating">';
            getStarRating($starRate);
            echo '
        </div>
         <p class="comment">' . $row["comment"] . '</p>
         <h5>By <span class="focusName">' . $row["usersName"] . '</span> | Date ' . $row["created_date"] . '</h5>
     </div>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    ?>
</section>
<?php
include('./common/footer.php');
