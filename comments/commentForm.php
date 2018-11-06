<?php  

//need to make sure user is logged in before displaying the form. 

// if ($loggedIn) {
//     show form
// } else {
//   show "must be logged in to comment."     
//}

?>


<h3>Leave a comment</h3>
     <p class="instructions">Hit the enter key twice to create a new paragraph. Basic html tags are allowed for bold and italicized text. If you would like to create a bulleted list, please use the asterisk (*) symbol.</p>
     <form action="comments/index.php">
          <input type="hidden" name="action" value="addComment">
          <!-- need to add userID here somewhere -->
          <textarea name="commentText" id="commentText" rows="10"></textarea>
          <input type="submit" name="sendComment" class="btn" value="Submit">
     </form>
     
     