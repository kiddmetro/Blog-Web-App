<?php 

require_once("../../config/db.php");


if(isset($_POST['delete_comment']))
{
    $commentId = mysqli_real_escape_string($db, $_POST['delete_comment']);

    $query = "DELETE FROM comments WHERE comment_id='$commentId' ";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Comment Deleted Successfully";
        header("Location: ../comment.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Comment Not Deleted";
        header("Location: ../comment.php");
        exit(0);
    }
}


?>