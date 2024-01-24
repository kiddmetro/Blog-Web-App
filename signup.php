<?php

$insertStmt = null;
$message = "";
$umessage = ""; 
$emessage = ""; 

require_once("./config/db.php"); // The file that keeps the database connection
include("./config/function.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $userimage = $_FILES['userimage']['name'];
    $username = $db->real_escape_string($_POST['username']);
    $firstname = $db->real_escape_string($_POST['firstname']);
    $lastname = $db->real_escape_string($_POST['lastname']);
    $email = $db->real_escape_string($_POST['email']);
    $password = $db->real_escape_string($_POST['password']);

     if (isset($_FILES['userimage']) && $_FILES['userimage']['error'] === UPLOAD_ERR_OK) {
        $userimage = $_FILES['userimage']['name'];
        // Rest of your code...
    } else {
        $errors[] = 'Error uploading the User Image.';
    }

    // Validate the inputs
    $errors = [];

    // Validate the salad image (you can modify this validation as per your requirements)
    if ($_FILES['userimage']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Error uploading the User Image.';
    } else {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $uploadedExtension = strtolower(pathinfo($_FILES['userimage']['name'], PATHINFO_EXTENSION));
        if (!in_array($uploadedExtension, $allowedExtensions)) {
            $errors[] = 'Invalid file format. Only JPG, JPEG, and PNG files are allowed.';
        }
    }

  // Generate a random salt
  $salt = generateSalt(); // Custom function to generate a salt

  // Encrypt the password
  $hashedPassword = crypt($password, $salt);
  if (!empty($username)) {
    // Check if username or email already exists using prepared statements
    $query = "SELECT * FROM users WHERE username=? OR email=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      if ($row['username'] === $username) {
          $umessage = "Username already taken";
      } else if ($row['email'] === $email) {
          $emessage = "Email already exists";
      }

    }  else {
            // Insert data into the database using prepared statements
            $insertQuery = "INSERT INTO users (user_image, username, firstname, lastname, email, password) VALUES (?, ?, ?, ?, ?, ?)";
            $insertStmt = $db->prepare($insertQuery);
            $insertStmt->bind_param("ssssss", $userimage, $username, $firstname, $lastname, $email, $hashedPassword);

            if ($insertStmt->execute()) {
              header("Location: login.php");
              exit();
            } else {
                $message = "Error: Failed to insert data into the database. " . $db->error;
            }
        }
    }
    $stmt->close();
} else {
    unset($_POST['username'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password']);
    $message = "";
}
// Function to generate a random salt
function generateSalt($length = 22) {
  $charset = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  $salt = '';
  for ($i = 0; $i < $length; $i++) {
    $salt .= $charset[mt_rand(0, strlen($charset) - 1)];
  }
  return $salt;
}

// Close $insertStmt if it's not null
if ($insertStmt !== null) {
  $insertStmt->close();
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

    <style>

         .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            text-align: center;
        }

        .popup-content {
            max-width: 300px;
            margin: auto;
        }

        .success-icon {
            width: 50px;
            height: 50px;
        }


        
    </style>


</head>
<body style="overflow-x: hidden; background: #DFF1F0;">

    <div class="container-lg d-flex justify-content-center align-items-center">
        <!-- CENTER CONTAINER -->
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

          
          <!-- FORM WRAPPER -->
           <div class="form-wrapper signup-form-wrapper">
            <a class="navbar-brand logo-form" href="#"><span class="blog-logo">Blog</span><span class="blog-logo2">Book</span><img src="./image/logo/logo.svg" class="logo-image" alt=""></a>
            <!-- SIGN UP FORM -->
            <form class="row g-3 " id="signup-form" action="signup.php" method="POST" enctype="multipart/form-data" >
                <div>
                    <h4 class="form-name ms-5">Create Account</h4>
                </div>
                <span id="error-message" ></span>
                <div class="col-12">
                    <label for="profile-image" class="ms-5 text-primary" >Profile Image:</label>
                    <input type="file" name="userimage" id="user-image" class="form-control form-sty" required>
                </div>
                <div class="col-12">
                    <input type="text" class="form-sty" id="first-name"  name="firstname" placeholder="First Name" required>
                </div>
                <div class="col-12">
                    <input type="text" class="form-sty"  id="last-name" name="lastname" placeholder="Last Name" required>
                </div>
                <div class="col-12">
                    <input type="text" class="form-sty" id="user-name" name="username" placeholder="User Name" required>
                    <div class="ms-5"  id="error-message" style="color:red;"><?php echo $umessage; ?></div>
                </div>
                <div class="col-12 d-block">
                    <input type="email" class="form-sty" id="email" name="email" placeholder="Email" required>
                    <div class="ms-5"  id="error-message" style="color:red;"><?php echo $emessage; ?></div>
                </div>
                <div class="col-12">
                  <input type="password" class="form-sty" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="col-12 ms-5">
                  <div class="form-check check-box mt-1">
                    <input class="form-check-input" type="checkbox" id="grid-check" required>
                    <label class="form-check-label check-box" for="grid-check">
                     Agree to <a href="">Terms</a> & <a href="">Conditions</a>
                    </label>
                  </div>
                </div>
                <div class="col-12 justify-content-center align-items-center">
                  <button type="submit" name="submit" class="btn btn-primary ms-5 text-light general-button" >Create Account</button>
                </div>
                <div class="ms-5">
                    <p class="acc-text">Already have an account? <a href="login.php" class="choice-text">Log In</a></p>
                </div>
            </form>

            
           </div>
        </div>
    </div>

    <!-- Success Popup -->
<!-- <div class="popup" id="successPopup">
    <div class="popup-content">
        <img src="" alt="Success Icon" class="success-icon">
        <p class="success-message">Account created successfully!</p>
        <p>REDRIRECTING</p>
    </div>
</div> -->


    


    



    <script src="assets/js/index.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>

</body>
</html>