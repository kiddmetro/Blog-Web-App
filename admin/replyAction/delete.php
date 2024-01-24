<?php 

require_once("../../config/db.php");


if(isset($_POST['delete_reply']))
{
    $replyId = mysqli_real_escape_string($db, $_POST['delete_reply']);

    $query = "DELETE FROM replies WHERE reply_id='$replyId' ";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Reply Deleted Successfully";
        header("Location: ../replies.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Reply Not Deleted";
        header("Location: ../replies.php");
        exit(0);
    }
}


?>