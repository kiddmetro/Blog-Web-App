<?php

require_once("../config/db.php");


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form inputs
    $blogImage = $_FILES['blogimage']['name'];
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $blogTitle = isset($_POST['blogtitle']) ? $_POST['blogtitle'] : '';
    $adminName = isset($_POST['adminname']) ? $_POST['adminname'] : '';
    $adminImage = $_FILES['adminimage']['name'];
    $readTime = isset($_POST['readtime']) ? $_POST['readtime'] : '';
    $blogText = isset($_POST['blogtext']) ? $_POST['blogtext'] : '';

    // Validate the inputs
    $errors = [];

    // Validate the salad image (you can modify this validation as per your requirements)
    if ($_FILES['blogimage']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Error uploading the Blog Image.';
    } else {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $uploadedExtension = strtolower(pathinfo($_FILES['blogimage']['name'], PATHINFO_EXTENSION));
        if (!in_array($uploadedExtension, $allowedExtensions)) {
            $errors[] = 'Invalid file format. Only JPG, JPEG, and PNG files are allowed.';
        }
    }

    if (empty($errors)) {

        // Get the current timestamp for publication date
        $publicationDate = date('Y-m-d H:i:s');
        // Format the date for display purposes
        
        $formattedDate = date('M d, Y', strtotime($publicationDate));


        // Save the inputs in the database
        $host = 'localhost';
        $db = 'blog_database';
        $user = 'root';
        $password = '';

        // Create a PDO instance
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO blogs (image, category, title, author_name, author_image, read_time, sample_text, publication_date, formatted_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Execute the statement with the form inputs
        $stmt->execute([$blogImage, $category, $blogTitle, $adminName, $adminImage, $readTime, $blogText, $publicationDate, $formattedDate ]);


        // Redirect to the frontend page or display success message
        header("Location: index.php");
        exit(); 
    }
}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">

    <style>

         /* .popup {
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
        } */


    textarea {
        height: 100px; /* Adjusted height */
        /* padding: 10px; */
        resize: none;
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
                    <img src="../image/manager-monochromatic.png" class="mt-5" alt="">  
                </div>
                <div class="text-overlay">
                    <p>CONTROL THE WORLD AT THE PALM OF YOUR HANDS</p>
                </div>
                
            </div>

          
          <!-- FORM WRAPPER -->
           <div class="form-wrapper signup-form-wrapper">
            <a class="navbar-brand logo-form" href="#"><span class="blog-logo">Blog</span><span class="blog-logo2">Book</span><img src="../image/logo/logo.svg" class="logo-image" alt=""></a>
            <!-- SIGN UP FORM -->
            <form class="row g-3 " action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" >
                <div>
                    <h4 class="form-name ms-5">Upload Blog</h4>
                </div>
                <div class="col-12">
                    <input type="file" name="blogimage" id="blog-image" class="form-control form-sty" required>
                    <div class="ms-5"  id="error-message" style="color:red;"></div>
                </div>
                <div class="col-12">
                    <input type="text" class="form-sty"  id="blog-category" name="category" placeholder="Category e.g Travel, Science, Fashion" required>
                </div>
                <div class="col-12">
                    <input type="text" class="form-sty" id="blog-title" name="blogtitle" placeholder="Title" required>
                </div>
                <div class="col-12 d-block">
                    <input type="text" class="form-sty" id="admin-name" name="adminname" placeholder="Admin Name" required>
                    <!-- <div class="ms-5"  id="error-message" style="color:red;"><?php echo $emessage; ?></div> -->
                </div>
                <div class="col-12 d-block">
                    <input type="file" name="adminimage" id="admin-image" class="form-control form-sty" placeholder="Choose an Image" required>
                    <!-- <div class="ms-5"  id="error-message" style="color:red;"><?php echo $emessage; ?></div> -->
                </div>
                <div class="col-12 d-block">
                    <input type="text" class="form-sty" id="read-time" name="readtime" placeholder="Read Time" required>
                    <!-- <div class="ms-5"  id="error-message" style="color:red;"><?php echo $emessage; ?></div> -->
                </div>
    
              <div class="col-12 d-flex">
                    <textarea id="blog-text" name="blogtext" class="form-sty" placeholder="Type something here..."></textarea>
              <button type="button" onclick="showText()" class="btn btn-sm btn-outline-primary">View Text</button>

              </div>
                
                <div class="col-12 justify-content-center align-items-center">
                  <button type="submit" name="submit" class="btn btn-primary ms-5 text-light general-button">Upload Blog</button>
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
    

    <script>
        function showText() {
            // Get the content of the textarea
            const text = document.getElementById('blog-text').value;

            // Display the content (you can modify this part based on your needs)
            alert('Text content:\n' + text);
        }
    </script>

    <script src="assets/js/index.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>

</body>
</html> 