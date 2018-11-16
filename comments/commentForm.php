<?php  
if (!isset($_SESSION)) {
     session_start();
}

$userID = $_SESSION['user'];


?>


<h3>Leave a comment</h3>
     <p class="instructions">Hit the enter key twice to create a new paragraph. Basic html tags are allowed for bold and italicized text. If you would like to create a bulleted list, please use the asterisk (*) symbol.</p>
     <form action="comments/index.php" method="post">
          <input type="hidden" name="action" value="addComment">
          <input type="hidden" name="userID" value="<?php echo $userID;?>">
          <textarea name="commentText" id="commentText" rows="10"></textarea>
          <input type="submit" name="sendComment" class="btn" value="Submit">
     </form>
     
     