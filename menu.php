<?php
// Set error reporting to show all errors except notices
error_reporting(E_ALL & ~E_NOTICE);

// Include necessary configuration files and functions
require_once 'includes/ini.php';
require_once 'includes/functions.php';

// Include the common header
include("./common/head.php");
?>

<link rel="stylesheet" href="common/styles/menu.css">

<section style="background-image: url(common/images/body-bg1.png);">
    <div class="highlight-section">
        <p class="sh-header-p menu-page">Our Menu</p>
        <br><br>
    </div>
     <!-- Menu categories -->
    <ul class="filter-menu-box flex-row">
        <li class="flex-column filter">
            <a href="menu.php">
                <?php include("./common/images/svg/menu-all.php"); ?>
                <div>All</div>
            </a>
        </li>
        <li class="flex-column filter">
            <a href="menu.php?type=soup">
                <?php include("./common/images/svg/menu-soup.php"); ?>
                <div>Soup</div>
            </a>
        </li>
        <li class="filter flex-column">
            <a href="menu.php?type=stir-fry">
                <?php include("./common/images/svg/menu-stirFry.php"); ?>
                <div>Stir-Fry</div>
            </a>
        </li>
        <li class="filter flex-column">
            <a href="menu.php?type=grill">
                <?php include("./common/images/svg/menu-grill.php"); ?>
                <div>Grill/Fried</div>
            </a>
        </li>
        <li class="filter flex-column">
            <a href="menu.php?type=salad">
                <?php include("./common/images/svg//menu-salad.php"); ?>
                <div>Salad</div>
            </a>
        </li>
        <li class="filter flex-column">
            <a href="menu.php?type=noodles">
                <?php include("./common/images/svg/menu-noodles.php"); ?>
                <div>Noodles</div>
            </a>
        </li>
        <li class="filter flex-column">
            <a href="menu.php?type=desserts">
                <?php include("./common/images/svg/menu-sweet.php"); ?>
                <div>Desserts</div>
            </a>
        </li>
    </ul>
    <!-- Display the menu items -->
    <div class="our-menu flex-row">
        <?php
        // SQL query to select menu items and calculate average ratings
        $sql = "SELECT *, ROUND(AVG(dish_rating), 0) AS round_rate FROM recipes LEFT JOIN comment ON recipes.id = comment.dish_id GROUP BY recipes.id;";
        
        // Check if a filter type is provided in the URL
        if (isset($_GET["type"])) {
            // Adjust the SQL query based on the filter type
            if ($_GET["type"] == "soup") {
                $sql = "SELECT *, ROUND(AVG(dish_rating), 0) AS round_rate FROM recipes LEFT JOIN comment ON recipes.id = comment.dish_id GROUP BY recipes.id HAVING type = 'Soup';";
            } elseif ($_GET["type"] == "stir-fry") {
                $sql = "SELECT *, ROUND(AVG(dish_rating), 0) AS round_rate FROM recipes LEFT JOIN comment ON recipes.id = comment.dish_id GROUP BY recipes.id HAVING type = 'Stir-fry';";
            } elseif ($_GET["type"] == "grill") {
                $sql = "SELECT *, ROUND(AVG(dish_rating), 0) AS round_rate FROM recipes LEFT JOIN comment ON recipes.id = comment.dish_id GROUP BY recipes.id HAVING type = 'Grill/fried';";
            } elseif ($_GET["type"] == "salad") {
                $sql = "SELECT *, ROUND(AVG(dish_rating), 0) AS round_rate FROM recipes LEFT JOIN comment ON recipes.id = comment.dish_id GROUP BY recipes.id HAVING type = 'Salad';";
            } elseif ($_GET["type"] == "noodles") {
                $sql = "SELECT *, ROUND(AVG(dish_rating), 0) AS round_rate FROM recipes LEFT JOIN comment ON recipes.id = comment.dish_id GROUP BY recipes.id HAVING type = 'Noodles';";
            } elseif ($_GET["type"] == "desserts") {
                $sql = "SELECT *, ROUND(AVG(dish_rating), 0) AS round_rate FROM recipes LEFT JOIN comment ON recipes.id = comment.dish_id GROUP BY recipes.id HAVING type = 'Desserts';";
            } else {
                $sql = "SELECT *, ROUND(AVG(dish_rating), 0) AS round_rate FROM recipes LEFT JOIN comment ON recipes.id = comment.dish_id GROUP BY recipes.id;";
            }
        }
        
        try {
            // Prepare and execute the SQL statement
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            
            // Set the result fetch mode to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
            // Fetch all menu items and display them
            $result = $stmt->fetchAll();
            
            foreach ($result as $row) {
                echo '
                <div class="dish-box">
                    <a href="dish.php?foodid=' . $row["id"] . '">
                        <div class="dish-img">
                            <img src="' . $row["image"] . '" alt="' . $row["thai_name"] . '">
                        </div><br>
                        <div class="dish-rating">';
                        $starRate = $row["round_rate"];
                        getStarRating($starRate);
                        echo '
                        </div>
                        <div class="dish-title">
                            <h3 class="h3-title">' . $row["thai_name"] . '</h3>
                        </div>
                    </a>
                    <ul class="flex-row dish-info">
                        <div class="dish-info-left dish-text">
                            <li>
                                <p>Type</p>
                            </li>
                            <li>
                                <strong>' . $row["type"] . '</strong>
                            </li>
                        </div>
                        <div class="dish-info-right dish-text">
                            <li>
                                <p>Persons</p>
                            </li>
                            <li>
                                <strong>' . $row["max_serve"] . '</strong>
                            </li>
                        </div>
                    </ul>
                    <br>
                    <hr><br>
                    <p>' . $row["calories"] . ' calories</p><br>
                </div>';
            }
        } catch (PDOException $e) {
            // Handle any database errors
            echo "Error: " . $e->getMessage();
        }
        ?>
    </div>
</section>

<?php
// Include the common footer
include('./common/footer.php');
?>
