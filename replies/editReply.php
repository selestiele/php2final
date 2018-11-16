<?php  
if (!isset($_SESSION)) {
     session_start();
}

$userID = $_SESSION['user'];

require('../util/paths.php');
include '../view/header.php';

?>

<main class="page">
     <section class="commentForm">
          <h3>Edit your comment</h3>
          <form action="index.php" method="post">
               <input type="hidden" name="action" value="updateReply">
               <input type="hidden" name="userID" value="<?php echo $userID;?>">
               <input type="hidden" name="replyID" value="<?php echo $replyID; ?>">
               <textarea name="replyText" id="replyText" rows="10"><?php echo $text[0]; ?></textarea>
               <input type="submit" name="updateReply" class="btn" value="Submit">
          </form>
     </section>
</main>

<?php include '../view/footer.php'; ?>