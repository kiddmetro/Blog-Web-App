<?php

require_once("../config/db.php");



try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle database connection error
    echo "Connection failed: " . $e->getMessage();
    die();
}

// COMMENT SECTION
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comment-submit"])){

    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        // Retrieve the username from the users table
        $query = "SELECT username FROM users WHERE user_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$userId]);

        // Check if the user exists and fetch the username
        if ($stmt->rowCount() > 0) {
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            $userName = $userData['username'];
        } else {
            // Handle the case where the user does not exist
            $userName = 'anonymous';
            $userId = 0; 
        }

    } else {
        // If the user is not logged in, provide default values
        $userName = 'anonymous';
        $userId = 0; 
    }

    echo "User ID: " . $userId . "<br>";
    echo "Username: " . $userName . "<br>";

    
    // Assuming $commentDate is the timestamp retrieved from the database
    $commentDate = isset($commentDate) ? date('Y-m-d H:i:s', $commentDate) : date('Y-m-d H:i:s');


    $blogId = $_POST['blog_id'];
    $blogTitle = $_POST['title'];
    $commentText = $_POST["commenttext"];

    // Initialize $userImage with a default value
    $userImage = '../image/cover-image/logo.png';  // Replace 'default_image.jpg' with the default image filename or path

    $query = "SELECT user_image FROM users WHERE user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$userId]);
    

    // Check if the user_image is fetched successfully
    if ($stmt->rowCount() > 0) {
        $userImage = $stmt->fetchColumn();  // Retrieve the user_image column
    }

    $stmt->closeCursor(); // Use closeCursor() instead of close()

    // Insert the comment into the comments table
    $sql = "INSERT INTO comments (user_image, blog_id, user_id, username, comment_text, comment_date) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userImage, $blogId, $userId, $userName, $commentText, $commentDate]);

    // Optionally, you can redirect the user to the blog page or do some other action
    header("Location: ../page-blog.php?blog_id=" . $blogId . "&title=" . urlencode($blogTitle) . "&user_id=" . $userId);
    exit();
}
?>
