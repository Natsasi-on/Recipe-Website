<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="common/styles/shares.css">
    <title>All Recipes</title>
</head>

<body>
    <header>
        <nav>
            <ul class="flex-row nav-header">
                <div class="header-logo">
                    <a href="index.php">
                        <img src="common/images/logo.svg" height="36" alt="Logo">
                    </a>
                </div>
                <?php
                if (!isset($_SESSION["userNameDB"])) {
                } else {
                    echo '
                <div class="sh-icon-box focus-header">
                    <li>Hello! ' . $_SESSION["userNameDB"] . '</li>
                </div>';
                }
                ?>

                <div class="flex-row right-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="index.php#gallery">Gallery</a></li>
                    <li><a href="index.php#blog">Blog</a></li>
                    <li><a href="index.php#about">About</a></li>
                    <li><a href="index.php#contact">Contact</a></li>
                    <form action="#" class="header-search-form sh-icon-box">
                        <input type="search" placeholder="Search Here...">
                        <button type="submit" name="search-btn" class="search-btn">
                            <svg viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
                                <path d="M14.6,12.6l-3-3c0.5-0.8,0.8-1.8,0.8-2.9c0-3-2.4-5.5-5.5-5.5S1.6,3.7,1.6,6.8S4,12.2,7,12.2c1,0,2-0.3,2.9-0.8l3,3
	c0.5,0.5,1.3,0.5,1.8,0C15.1,13.8,15.1,13.1,14.6,12.6z M7,10.5c-2.1,0-3.8-1.7-3.8-3.8S5,3,7,3s3.8,1.7,3.8,3.8S9.1,10.5,7,10.5z" />
                            </svg>
                        </button>
                    </form>

                    <div class="sh-icon-box">
                        <li><a href="registration.php"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
                                    <path d="M6.9,8.3c1.9,0,3.4-1.5,3.4-3.4S8.8,1.4,6.9,1.4S3.4,3,3.4,4.9S5,8.3,6.9,8.3z M9.1,4.9c0,1.3-1,2.3-2.3,2.3s-2.3-1-2.3-2.3
                           s1-2.3,2.3-2.3S9.1,3.6,9.1,4.9z M13.7,14c0,1.1-1.1,1.1-1.1,1.1H1.1c0,0-1.1,0-1.1-1.1s1.1-4.6,6.9-4.6S13.7,12.9,13.7,14z
                            M12.6,14c0-0.3-0.2-1.1-1-1.9c-0.7-0.7-2.1-1.5-4.8-1.5c-2.6,0-4,0.8-4.8,1.5c-0.8,0.8-0.9,1.6-1,1.9H12.6z" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.1,4.9c0.3,0,0.6,0.3,0.6,0.6v1.7h1.7c0.3,0,0.6,0.3,0.6,0.6s-0.3,0.6-0.6,0.6
                           h-1.7V10c0,0.3-0.3,0.6-0.6,0.6s-0.6-0.3-0.6-0.6V8.3h-1.7c-0.3,0-0.6-0.3-0.6-0.6s0.3-0.6,0.6-0.6h1.7V5.4
                           C12.6,5.1,12.8,4.9,13.1,4.9z" />
                                </svg></a></li>
                    </div>
                    <?php
                    if (!isset($_SESSION["userNameDB"])) {
                        echo '
                    <div class="sh-icon-box">
                        <li>
                            <a href="login.php">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
                                    <g>
                                        <path d="M6.9,8.3c1.9,0,3.4-1.5,3.4-3.4S8.8,1.4,6.9,1.4S3.4,3,3.4,4.9S5,8.3,6.9,8.3z M9.1,4.9c0,1.3-1,2.3-2.3,2.3
                                    s-2.3-1-2.3-2.3s1-2.3,2.3-2.3S9.1,3.6,9.1,4.9z M13.7,14c0,1.1-1.1,1.1-1.1,1.1H1.1c0,0-1.1,0-1.1-1.1s1.1-4.6,6.9-4.6
                                    S13.7,12.9,13.7,14z M12.6,14c0-0.3-0.2-1.1-1-1.9c-0.7-0.7-2.1-1.5-4.8-1.5c-2.6,0-4,0.8-4.8,1.5c-0.8,0.8-0.9,1.6-1,1.9H12.6z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9,5.9c0.2-0.2,0.4-0.2,0.6,0l1.3,1.5c0.2,0.2,0.2,0.5,0,0.7l-1.3,1.5
                                    c-0.2,0.2-0.4,0.2-0.6,0s-0.2-0.5,0-0.7l0.6-0.6h-3.7c-0.2,0-0.4-0.2-0.4-0.5c0-0.3,0.2-0.5,0.4-0.5h3.7l-0.6-0.6
                                    C13.7,6.4,13.7,6.1,13.9,5.9z" />
                                    </g>
                                </svg>
                            </a>
                        </li>
                    </div>';
                    } else {
                        echo '
                    <div class="sh-icon-box">
                        <li>
                            <a href="logout.php">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
                                <g>
                                <path fill="#FF8243" d="M6.9,8.3c1.9,0,3.4-1.5,3.4-3.4S8.8,1.4,6.9,1.4S3.4,3,3.4,4.9S5,8.3,6.9,8.3z M9.1,4.9
                                c0,1.3-1,2.3-2.3,2.3s-2.3-1-2.3-2.3s1-2.3,2.3-2.3S9.1,3.6,9.1,4.9z M13.7,14c0,1.1-1.1,1.1-1.1,1.1H1.1c0,0-1.1,0-1.1-1.1
                                s1.1-4.6,6.9-4.6S13.7,12.9,13.7,14z M12.6,14c0-0.3-0.2-1.1-1-1.9c-0.7-0.7-2.1-1.5-4.8-1.5c-2.6,0-4,0.8-4.8,1.5
                                c-0.8,0.8-0.9,1.6-1,1.9H12.6z"/>
                                </g>
                                <path fill="#FF8243" d="M5.1,10.3c-0.9,0.2-2,0.4-3,1.2c-0.1,0.1-0.8,0.7-1.2,1.6c-0.2,0.5-0.4,0.9-0.3,1.1c0.3,0.5,1.4,0.3,2.8,0.2
                                c0.5,0,2,0,5,0.1c2.9,0.1,3.9,0.3,4.3-0.3c0.4-0.6-0.1-1.6-0.2-1.8c-0.5-1-1.4-1.3-2.4-1.7C7.7,9.8,5.6,10.2,5.1,10.3z"/>
                                <path fill="#FF8243" d="M6.4,7.5c-0.2-0.1-1.6-0.5-2-1.8c0-0.1-0.4-1.2,0.3-2.3c0.4-0.6,0.9-0.9,1.2-1c0.3-0.1,1-0.5,1.8-0.2
                                C8.3,2.5,8.7,3,9,3.4C9.2,3.8,9.6,4.3,9.6,5c0,0.8-0.3,1.9-1.2,2.4C7.5,7.9,6.7,7.6,6.4,7.5z"/>
                                <path fill="#FF8243" d="M10.4,7.8c0-0.3,0.2-0.5,0.3-0.5h4.7c0.2,0,0.3,0.2,0.3,0.5c0,0.3-0.2,0.5-0.3,0.5h-4.7
                                C10.6,8.2,10.4,8,10.4,7.8z"/>
                                </svg>
                            </a>
                        </li>
                    </div>';
                    }

                    ?>
                    <!-- <div class="sh-icon-box">
                        <li>
                            <a href="login.php">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
                                    <g>
                                        <path d="M6.9,8.3c1.9,0,3.4-1.5,3.4-3.4S8.8,1.4,6.9,1.4S3.4,3,3.4,4.9S5,8.3,6.9,8.3z M9.1,4.9c0,1.3-1,2.3-2.3,2.3
                                    s-2.3-1-2.3-2.3s1-2.3,2.3-2.3S9.1,3.6,9.1,4.9z M13.7,14c0,1.1-1.1,1.1-1.1,1.1H1.1c0,0-1.1,0-1.1-1.1s1.1-4.6,6.9-4.6
                                    S13.7,12.9,13.7,14z M12.6,14c0-0.3-0.2-1.1-1-1.9c-0.7-0.7-2.1-1.5-4.8-1.5c-2.6,0-4,0.8-4.8,1.5c-0.8,0.8-0.9,1.6-1,1.9H12.6z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9,5.9c0.2-0.2,0.4-0.2,0.6,0l1.3,1.5c0.2,0.2,0.2,0.5,0,0.7l-1.3,1.5
                                    c-0.2,0.2-0.4,0.2-0.6,0s-0.2-0.5,0-0.7l0.6-0.6h-3.7c-0.2,0-0.4-0.2-0.4-0.5c0-0.3,0.2-0.5,0.4-0.5h3.7l-0.6-0.6
                                    C13.7,6.4,13.7,6.1,13.9,5.9z" />
                                    </g>
                                </svg>
                            </a>
                        </li>
                    </div> -->
                </div>
            </ul>
        </nav>
        <div class="banner">
            <img id="first-item" src="common/images/chili.png" alt="decoration-img" height="200px">
            <div id="second-item" class="banner-text">
                <h1>Authentic <span id="focus-header">Thai</span> Recipes.</h1>
                <p>This is Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam eius
                    vel tempore consectetur nesciunt? Nam eius tenetur recusandae optio aperiam.</p>
                <div>
                    <a href="menu.php" class="sh-btn-link moreMenu-btn">Check our Menu</a>
                </div>
            </div>
            <div id="third-item" class="banner-big-img">
                <img src="common/images/header-bg.jpg" alt="decoration-img" height="300px">
                <h5 class="h5-title">Som Tam Thai</h5>
                <p>Green papaya salad is a spicy salad made from shredded unripe papaya.</p>
            </div>
            <img id="fourth-item" src="common/images/kaffir-lime.png" alt="decoration-img">
        </div>
    </header>