<?php 
// Start session if one hasn't already been started
if (!isset($_SESSION)) {
     session_start();
 }

require('util/paths.php');
include 'view/header.php';

?>


<main class="homepage">
<section class="sidebar">
     <?php if (!isset($_SESSION['verifiedUser'])) : ?>
          <div id="loginFormHeader">
               <img src="assets/images/rainbowleaveslogin.png" alt="rainbow leaves" class="loginImg">
               <p class="loginHeading">User Login</p>
          </div>
          <p id="authMsg"><?php echo $authMessage; ?></p>
          <form action="admin/login.php" method="post" id="loginForm">
                    <input type="text" name="username" placeholder="Username" class="loginText formText" id="username">
                    <input type="password" name="password" placeholder="Password" class="loginText formText" id="password">
                    <input type="submit" value="Login" class="btn login">
               </form>
     <?php  else : ?>
        <div id="loginFormHeader">
            <img src="assets/images/rainbowleaveslogin.png" alt="rainbow leaves" class="loginImg">
            <p class="loginHeading"><?php echo 'Welcome, ' . $_SESSION['user']; ?></p>
        </div>
          <form action="index.php" method="post" id="logout">
               <input type="hidden" name="action" value="logout">
               <input type="submit" value="Logout" class="btn login">
          </form>
     <?php endif; ?>

</section>



<section class="post">
<h2>This is the title of the post </h2>
<p>This is the body of the post. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod dolore voluptatibus commodi voluptates rem tempora sequi, beatae delectus deserunt voluptatem mollitia repellat consequatur maiores! Perferendis doloremque accusantium fuga dolor ea.</p>
<form action="" method="post" class="formBtns">
     <input type="hidden" name="action" value="addComment">
     <input type="submit" class="addComment btn" value="Add a Comment">
</form>

</section>

<section class="commentsSection">
     <h2><?php echo $numComments . ' '; ?>Comments</h2>
     
     <!-- Check if there are replies to the comment ID; if so, show them. If not, just show the comment. -->

     
     <!-- Loop through the comments -->
     <?php foreach ($commentArray as $comment) : ?>
        <div class="comment">
            <!-- avatar linked to the user  -->
            <img src="assets/images/<?php echo $comment['userID'];?>icon.png" alt="avatar for user" class="usericon">
            <!-- User linked here -->
            <p class="usertitle"><?php echo $comment['userID'];?> says:</p>
            <p class="responseDate">
                <?php echo $comment['commentDate']; ?></p>
            <!-- Comment body -->
            <?php echo addTags($comment['commentText']); ?>
                
                <?php if (isset($_SESSION['user'])) : ?>
                    <form action="" method="post" class="formBtns">
                        <input type="hidden" name="action" value="addReply">
                        <input type="submit" class="addReply btn" value="Reply">
                    </form>

                    <?php if ($_SESSION['user'] == $comment['userID']) : ?>
                        <form action="" method="post" class="formBtns">
                            <input type="hidden" name="action" value="editComment">
                            <input type="hidden" name="commentID" value="<?php echo $comment['commentID'];?>">
                            <input type="submit" class="edit btn" value="Edit">
                        </form>
                        <form action="" method="post" class="formBtns">
                            <input type="hidden" name="action" value="deleteComment">
                            <input type="hidden" name="commentID" value="<?php echo $comment['commentID'];?>">
                            <input type="submit" class="delete btn" value="Delete">
                        </form>
                    <?php endif; ?>   
                <?php endif; ?>
        </div>  
    <?php endforeach; ?>    

    <?php if ($numReplies != 0) : ?>
        <?php foreach ($replyArray as $reply) :?>
            <div class="response">
                <img src="assets/images/<?php echo $reply['userID'];?>icon.png" alt="avatar for user" class="usericon">
                <p class="usertitle"><?php echo $reply['userID']; ?> says:</p>
                <p class="responseDate"><?php echo $reply['replyDate']; ?></p>
                <?php echo addTags($reply['replyText']); ?>
            
                    <?php if (isset($_SESSION['user']) && $_SESSION['user'] == $reply['userID']) : ?>
                        <form action="" method="post" class="formBtns">
                            <input type="hidden" name="action" value="editReply">
                            <input type="hidden" name="replyID" value="<?php echo $reply['replyID']; ?>">
                            <input type="submit" class="edit btn" value="Edit">
                        </form>
                        <form action="" method="post" class="formBtns">
                            <input type="hidden" name="action" value="deleteReply">
                            <input type="hidden" name="replyID" value="<?php echo $reply['replyID']; ?>">
                            <input type="submit" class="delete btn" value="Delete">
                        </form>
                    <?php endif; ?>
            </div>
        <?php endforeach; 
    endif; ?>
    


    <div id="commentForm">
        <?php include 'comments/commentForm.php'; ?>
    </div>

</section>

</main>

<?php include 'view/footer.php'; ?>