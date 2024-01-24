<?php

$emessage = ""; 
$pmessage = "";

// session_start();
require_once("./config/db.php");
include("./config/function.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($db, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $userdata = mysqli_fetch_assoc($result);

            // Verify the hashed password
            if (password_verify($password, $userdata['password'])) {
                // Password is correct
                session_start();
                $_SESSION['user_id'] = $userdata['user_id'];
                header("Location: index.php");
                exit();
            } else {
                 // Password is incorrect
                 $pmessage = "Invalid password.";
            }
        } else {
            // User not found
            $emessage = "Invalid username.";
        }
    } 
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/fontawesome.css">


</head>
<body style="overflow-x: hidden; background: #DFF1F0;">
    
    <div class="container-lg d-flex justify-content-center align-items-center">
        <div class="center-wrapper container-lg" >
            
            <div class="signup-wrapper">
                <a class="navbar-brand logo" href="#"><span class="blog-logo">Blog</span><span class="blog-logo2">Book</span><img src="./image/logo/logo.svg" class="logo-image" alt=""></a>
                <div id="signup-bg">
                    <img src="./image/knowledge-monochromatic.png" alt="">  
                </div>
                <div class="text-overlay">
                    <p>WRITE THE WORLD BLOG YOUR THOUGHTS</p>
                </div>
                
            </div>

          
          
           <div class="form-wrapper">
            <a class="navbar-brand logo-form" href="#"><span class="blog-logo">Blog</span><span class="blog-logo2">Book</span><img src="./image/logo/logo.svg" class="logo-image" alt=""></a>
            <form class="row g-3" style="margin-top: 95px;" action="" method="POST">
                <div>
                    <h4 class="form-name ms-5" >Login Account</h4>
                </div>
                <div class="col-12 mt-5">
                    <input type="text" class="form-sty" id="user-name" name="username"  placeholder="User Name" required>
                    <div class="ms-5"  id="error-message" style="color:red;"><?php echo $emessage; ?></div>
                </div>
                <div class="col-12">
                  <input type="password" class="form-sty" id="password" name="password" placeholder="Password" required>
                  <div class="ms-5"  id="error-message" style="color:red;"><?php echo $pmessage; ?></div>
                </div>
                <div class="col-12 justify-content-center align-items-center">
                  <button type="submit" class="btn btn-primary ms-5 text-light general-button"   id="submit-btn" name="submit">Login</button>
                </div>
                <div class="ms-5 mt-3">
                    <p class="acc-text">Don't have an account? <a href="signup.php" class="choice-text">Signup</a></p>
                </div>
            </form> 
           </div>
        </div>
    </div>


    




    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script src="assets/js/index.js"></script>
</body>
</html>