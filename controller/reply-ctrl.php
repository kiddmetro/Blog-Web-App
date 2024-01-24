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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reply-submit"])) {

    // Retrieve the comment_id and blog_post_id from the form
    $commentId = $_POST["comment_id"];
    $blogId = $_POST["blog_id"];

    // Assuming $replyText is the reply text from the form
    $replyText = $_POST["replycomment"];
  // Check if the user is logged in
  if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Fetch username from the users table based on the user ID
    $getUsernameQuery = "SELECT username FROM users WHERE user_id = ?";
    $getUsernameStmt = $pdo->prepare($getUsernameQuery);
    $getUsernameStmt->execute([$userId]);

    // Check if a row is returned
    if ($row = $getUsernameStmt->fetch(PDO::FETCH_ASSOC)) {
        $userName = $row['username'];
    } else {
        // Default username if not found
        $userName = 'anonymous';
    }
    } else {
        // If the user is not logged in, provide default values
        $userName = 'anonymous';
        $userId = 0;
    }


    // Assuming $replyDate is the timestamp for the reply
    $replyDate = date('Y-m-d H:i:s');

    // Insert the reply into the replies table
    $sql = "INSERT INTO replies (comment_id, blog_id, user_id, username, reply_text, reply_date) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$commentId, $blogId, $userId, $userName, $replyText, $replyDate]);

    // Optionally, you can redirect the user back to the original page
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
}
?>
