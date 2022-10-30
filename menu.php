<?php

include("./Header.php");
?>

<br />
<section style="background-image: url(common/images/menu-bg.png);" class="our-menu section bg-light repeat-img" id="menu">
    <div class="sec-wp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-title text-center mb-5">
                        <p class="sec-sub-title mb-3">our menu</p>
                    </div>
                </div>
            </div>
            <div class="menu-tab-wp">
                <div class="row">
                    <div class="col-lg-12 m-auto">
                        <div class="menu-tab text-center">
                            <ul class="filters">
                                <div class="filter-active justify-content-center"></div>
                                <li class="filter flex-column align-self-end">
                                    <a href="menu.php" ;>
                                        <div><img src="common/images/all.svg" alt=""></div>
                                        <div style="color:black">All</div>
                                    </a>
                                </li>
                                <li class="filter flex-column align-self-end">
                                    <a href="menu.php?type=soup">
                                        <div><img src="common/images/soup.svg" alt=""></div>
                                        <div style="color:black">Soup</div>
                                    </a>
                                </li>
                                <li class="filter flex-column">
                                    <a href="menu.php?type=stir-fry">
                                        <div><img src="common/images/stirFry.svg" alt=""></div>
                                        <div style="color:black">Stir-Fry</div>
                                    </a>
                                </li>
                                <li class="filter flex-column">
                                    <a href="menu.php?type=grill">
                                        <div><img src="common/images/grill.svg" alt=""></div>
                                        <div style="color:black">Grill/Fried</div>
                                    </a>
                                </li>
                                <li class="filter flex-column">
                                    <a href="menu.php?type=salad">
                                        <div><img src="common/images/salad1.svg" alt=""></div>
                                        <div style="color:black">Salad</div>
                                    </a>
                                </li>
                                <li class="filter flex-column">
                                    <a href="menu.php?type=noodles">
                                        <div><img src="common/images/noodles.svg" alt=""></div>
                                        <div style="color:black">Noodles</div>
                                    </a>
                                </li>
                                <li class="filter flex-column">
                                    <a href="menu.php?type=desserts">
                                        <div><img src="common/images/sweet.svg" alt=""></div>
                                        <div style="color:black">Desserts</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="menu-list-row">
                <div class="row g-xxl-5 bydefault_show" id="menu-dish">



                    <?php
                    require_once 'includes/dbh.inc.php';
                    $conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);
                    if ($conn) {
                    } else {
                        echo 'Error';
                    }

                    $query = "SELECT * FROM recipes;";
                    if (isset($_GET["type"])) {
                        if ($_GET["type"] == "soup") {
                            $query = "SELECT * FROM recipes WHERE type = 'Soup';";
                        } elseif ($_GET["type"] == "stir-fry") {
                            $query = "SELECT * FROM recipes WHERE type = 'Stir-fry';";
                        } elseif ($_GET["type"] == "grill") {
                            $query = "SELECT * FROM recipes WHERE type = 'Grill/fried';";
                        } elseif ($_GET["type"] == "salad") {
                            $query = "SELECT * FROM recipes WHERE type = 'Salad';";
                        } elseif ($_GET["type"] == "noodles") {
                            $query = "SELECT * FROM recipes WHERE type = 'Noodles';";
                        } elseif ($_GET["type"] == "desserts") {
                            $query = "SELECT * FROM recipes WHERE type = 'Desserts';";
                        } else {
                            $query = "SELECT * FROM recipes;";
                        }
                    }


                    $connect = mysqli_query($conn, $query);
                    $num = mysqli_num_rows($connect);
                    if ($num > 0) {
                        while ($data = mysqli_fetch_assoc($connect)) {
                            echo '<div class="col-lg-4 col-sm-6 dish-box-wp breakfast" data-cat="breakfast">

                            <div class="dish-box text-center">
                                <a href="dish.php?foodid=' . $data["id"] . '">
                                    <div class="dist-img"><img src="' . $data["image"] . '" alt=""></div>
                                    <div class="dish-rating">
                                        <span class="dish-star" style="color:#ff8243">' . $data["rating"] . ' </span>
                                        <img src="common/images/filled-star.svg" height="20px" style="
                                        margin-bottom: 5px;>
                                    </div>
                                    <div class="dish-title">
                                        <h3 class="h3-title">' . $data["thai_name"] . '</h3>
                                    </div>
                                </a>
                                <div class="dish-info">
                                    <ul>
                                        <li>
                                            <p>Type</p><b>' . $data["type"] . '</b>
                                        </li>
                                        <li>
                                            <p>Persons</p><b>' . $data["max_serve"] . '</b>
                                        </li>
                                    </ul>
                                </div>
                                <p>' . $data["calories"] . ' calories</p>
                            </div>
                        </div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>




<?php

include('./Footer.php');
