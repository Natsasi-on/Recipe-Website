<?php
// Set error reporting to show all errors except notices
error_reporting(E_ALL & ~E_NOTICE);

// Include necessary PHP files
require_once 'includes/ini.php';
require_once 'includes/functions.php';
include("./common/head.php");
?>
<link rel="stylesheet" href="common/styles/index.css">

<!-- 5 Star Recipes -->
<section style="background-image: url(common/images/body-bg1.png);">
    <div class="highlight-section">
        <p class="sh-header-p">Popular Recipes</p>
        <h2 class="h2-title">5 Star Recipes</span></h2>
        <br>
        <div class="flex-row parent-highlight">
            <?php

            try {
                // SQL query to select popular recipes with a rating greater than 4
                $sql = "
                SELECT *, ROUND(AVG(dish_rating), 0) AS round_rate
                FROM recipes
                INNER JOIN comment ON recipes.id = comment.dish_id
                GROUP BY id
                HAVING round_rate = 5
                LIMIT 3";

                // Prepare and execute the SQL statement using a prepared statement
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                // Set the fetch mode to associative array
                $stmt->setFetchMode(PDO::FETCH_ASSOC);

                // Fetch and display multiple rows of data
                while ($row = $stmt->fetch()) {
                    echo '
                    <div class="sh-img-box highlight-menu">
                        <img class="img-mybox" src="' . $row["image"] . '" alt="' . $row["thai_name"] . '">
                        <h5 class="h5-title">' . $row["thai_name"] . '</h5>
                        <br>
                        <div class="sh-btn-div">
                            <a href="dish.php?foodid=' . $row["id"] . '" class="sh-btn-link">Read More</a>
                        </div>
                    </div>';
                }
            } catch (PDOException $e) {
                // Handle any database errors and display an error message
                echo "Error: " . $e->getMessage();
            }
            ?>
        </div>
    </div>
</section>

<!-- Highlight dishes -->
<section class="blog-section" id="blog">
    <div class="blog-menu-section">
        <img class="image-float-left" src="common/images/dish/kapao1.png" alt="kapao">
        <div class="blog-row">
            <h2 class="h2-title">Pork & Holy Basil Stir-fry (Pad Kra Pao)</h2>
            <p>Pad kaphrao, as well as pad thai, were one of the promoted dishes in local Thai food contests.
                Phat kaphrao was inspired by stir frying, a staple cooking process of Chinese cuisine.
                Some of the first four survivors of the Tham Luang cave rescue asked for phat kaphrao as their first proper meal after two weeks of being trapped inside the cave.</p>
            <br>
            <p>Pad kaphrao consists of meat such as pork, chicken, beef, and seafood stir fried with Thai holy
                basil and garlic. It is served with rice and topped up (optional) with fried eggs or khai dao. The main seasonings are soy sauce, Thai fish sauce, oyster sauce (optional), cane sugar, and bird's eye chili.
            </p>
        </div>
        <div class="blog-row">
            <img class="image-float-right" src="common/images/dish/kanamoukrob1.png" alt="kanamoudrob">
            <h2 class="h2-title h2-blog-menu">Chinese Broccoli with Crispy Pork Belly(Kana Moo Krob)</h2>
            <p>Consumed typically with jasmine rice, Kana Moo Krob is Chinese broccoli that is stir-fried over high heat and tossed with garlic, chili, and crunchy pork belly, topped with soybean sauce and oyster sauce to give it a sweet and salty taste.
            </p><br>
            <p>This is Lorem ipsum dolor sit amet consectetur adipisicing elit. At fugit laborum
                voluptas magnam sed ad illum? Minus officiis quod deserunt.
            </p>
        </div>
    </div>
</section>

<!-- Video section -->
<section style="background-image: url(common/images/body-bg2.png);" id="about">
    <div class="video-section">
        <p class="sh-header-p">About Us</p>
        <h2 class="h2-title">Popular Recipes Video</span></h2>
        <br>
        <p>
            Hear the inspirational story of street food chef Jay Fai, who puts a spin on tom yum soup and boasts a
            Michelin star for her crab omelets.</p>
        <iframe style="border-radius: 10px" width="560" height="335" src="https://www.youtube.com/embed/LZvmfBJoYJM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
        </iframe>
        <p>
            <a href="https://youtu.be/LZvmfBJoYJM" target="_blank">Street Food | Netflix</a>.
        </p>
    </div>
</section>

<!-- Gallery section -->
<section class="gallery-bg" id="gallery">
    <div class="gallery-section">
        <p class="sh-header-p">Gallery</p>
        <h2 class="h2-title">Our Gallery</span></h2>
        <br><br>
        <div class="slider">
            <div class="row-set">
                <?php
                // Query for dishes in the gallery
                try {
                    $sql = "SELECT * , ROUND(AVG(dish_rating), 0) AS round_rate
                    FROM recipes
                    INNER JOIN comment
                    ON recipes.id = comment.dish_id
                    GROUP BY id
                    HAVING Gallery = 1;";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                    echo '
                    <div class="sh-img-box gallery-box">
                        <img class="img-mybox img-gallery" src="' . $row["image"] . '" alt="' . $row["thai_name"] . '">
                        <h3 class="h3-title">' . $row["thai_name"] . '</h3>
                        <div class="star-rating">';
                            
                        $starRate = $row["round_rate"];
                        // Call a function to display star ratings
                        getStarRating($starRate);
                        echo '
                        </div>
                    </div>';
                    }
                } catch (PDOException $e) {
                    // Handle any database errors
                    echo "Error: " . $e->getMessage();
                }
                ?>
            </div>
            <div class="row-set">

                <?php
                // Query for dishes in the gallery
                try {
                    $sql = "SELECT * FROM recipes WHERE Gallery = 1;";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        echo '
                    <div class="sh-img-box gallery-box">
                        <img class="img-mybox img-gallery" src="' . $row["image"] . '" alt="' . $row["thai_name"] . '">
                        <h3 class="h3-title">' . $row["thai_name"] . '</h3>
                        <div class="star-rating">';
                        $starRate = $row["rating"];
                        // Call a function to display star ratings
                        getStarRating($starRate);
                        echo '
                        </div>
                    </div>';
                    }
                } catch (PDOException $e) {
                    // Handle any database errors
                    echo "Error: " . $e->getMessage();
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php
// Include the footer file to complete the web page
include('./common/footer.php');
?>
