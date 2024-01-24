<?php
// session_start();
require_once("./config/db.php");
include("./config/function.php");



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog :: <?php echo $page_name; ?></title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/fontawesome.css">

    

</head>
<body style="overflow-x: hidden;">
    <!-- NAV BAR -->
    <nav class="navbar navbar-expand-lg nav-background">
        <div class="container-lg">
        <a class="navbar-brand" href="#"><span class="blog-logo">Blog</span><span class="blog-logo2">Book</span><img src="./image/logo/logo.svg" class="logo-image" alt=""></a>
          <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end " id="navbarNav">
                <ul class="navbar-nav justify-content-end align-items-center ">
                    <li class="nav-item">
                    <a class="nav-menu" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-menu nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-menu nav-link" href="#">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-menu nav-link" href="#">Contact</a>
                    </li>

                    <?php 
                        if (!isset($_SESSION['user_id'])) {
                            // User is not logged in
                            echo '<li class="nav-item">
                                    <a class="nav-menu nav-link text-secondary fw-bold d-lg-none " href="login.php">LOGIN</a>
                                </li>';
                            echo '<li class="nav-item ">
                                    <a class="nav-menu nav-link text-primary fw-bold d-lg-none " href="signup.php">SIGNUP</a>
                                </li>';
                        }
                    ?>
                    <?php
                        if (isset($_SESSION['user_id'])) {
                            // User is logged in
                            echo '<li class="nav-item">
                                    <a class="nav-menu nav-link text-primary fw-bold d-lg-none " href="logout.php">LOGOUT</a>
                                </li>';

                        } 
                    ?>
                </ul>
          </div>
            <form class=" search-form">
                <input class="me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary  btn-sm " type="submit">Search</button>
            </form>

           
        </div>
       <div class="stat-container">
       <?php 
            if (!isset($_SESSION['user_id'])) {
                // User is not logged in
                echo '<a href="login.php"><button class="btn btn-outline-primary  btn-sm  user-stat me-2  ">Log in</button></a>';
                echo '<a href="signup.php"><button class="btn btn-primary  btn-sm  text-light user-stat " >Sign Up</button></a>';
            }
         ?>
       <?php
            if (isset($_SESSION['user_id'])) {
                // User is logged in
                echo '<a href="logout.php"><button class="btn btn-outline-primary  btn-sm  user-stat me-2  ">Logout</button></a>';
                echo '<a href=""><button class="btn btn-primary text-light btn-sm  user-stat me-2  ">View Info</button></a>';

            } 
        ?>

       
    
       </div>
           
    </nav>