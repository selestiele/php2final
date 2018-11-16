<?php  
if (!isset($_SESSION)) {
     session_start();
}

$userID = $_SESSION['user'];


?>

<form action="replies/index.php" method="post" id="replyForm">
     <input type="hidden" name="action" value="addReply">
     <input type="hidden" name="commentID" value="<?php echo $comment['commentID']; ?>">
     <input type="hidden" name="userID" value="<?php echo $_SESSION['user']; ?>">
     <textarea name="replyText" id="replyText"  rows="5"></textarea>
     <input type="submit" class="btn addReply" value="Submit Reply">
</form>