<?php
    if(isset($_SESSION['message'])) :
?>

<div style="margin-top: 40px; background-color: green; padding: 10px;">
    <strong style="color: white;"></strong> <?= $_SESSION['message']; ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
</div>

<?php 
    unset($_SESSION['message']);
    endif;
?>