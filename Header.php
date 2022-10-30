<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thai Recipes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="common/css/bootstrap.min.css">
    <link rel="stylesheet" href="common/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="common/css/shareStyle.css">
</head>

<body>
    <header class="site-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header-logo row">
                        <a href="index.php">
                            <img src="common/images/logo.svg" height="36" alt="Logo">
                            <?php
                            if (isset($_SESSION["useridfromDB"])) {
                                echo "<span class='topName'>Hello, " . $_SESSION["userNameDB"] . "</span>";
                            } else {
                            }
                            ?>
                        </a>
                    </div>
                </div>

                <div class="col-lg-10">
                    <div class="main-navigation">
                        <button class="menu-toggle"><span></span><span></span></button>
                        <nav class="header-menu">
                            <ul class="menu food-nav-menu">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="menu.php">Menu</a></li>
                                <li><a href="index.php#gallery">Gallery</a></li>
                                <li><a href="index.php#blog">Blog</a></li>
                                <li><a href="index.php#about">About</a></li>
                                <li><a href="#contact">Contact</a></li>
                            </ul>
                        </nav>
                        <!-- search---------------------------- -->
                        <div class="header-right">
                            <form action="#" class="header-search-form for-des">
                                <input type="search" class="form-input" placeholder="Search Here...">
                                <button type="submit">
                                    <i class="uil uil-search"></i>
                                </button>
                            </form>
                            <?php
                            if (isset($_SESSION["useridfromDB"])) {
                                $bar = '<a href="index.php" class="header-btn">
                                <i class="uil uil-user-md"></i>
                                <img src="common/images/profile.svg" alt="alt" height="20px" />
                            </a>';
                                $bar2 = '<a href="includes/logout.inc.php" class="header-btn">
                            <i class="uil uil-user-md"></i>
                            <img src="common/images/logout.svg" alt="alt" height="20px" />
                        </a>';
                                echo $bar;
                                echo $bar2;
                            } else {
                                $bar3 = '<a href="signup.php" class="header-btn">
                                <i class="uil uil-user-md"></i>
                                <img src="common/images/regis.svg" alt="alt" height="20px" />
                            </a>';
                                $bar4 = '<a href="loginV2.php" class="header-btn">
                                <i class="uil uil-user-md"></i>
                                <img src="common/images/login_no_filled.svg" alt="alt" height="20px" />
                            </a>';
                                echo $bar3;
                                echo $bar4;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>