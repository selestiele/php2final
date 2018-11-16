<?php 
// Start session if one hasn't already been started
if (!isset($_SESSION)) {
     session_start();
} 



// required files for styling and header
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
          <p id="authMsg"><?php echo $_SESSION['authMessage']; ?></p>
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
<p>This is the body of the post. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc iaculis est vel felis rutrum sodales. Phasellus sed gravida enim. Suspendisse in erat a nisi vehicula gravida. Etiam ultrices enim eu vehicula placerat. Phasellus elementum lobortis dui sit amet eleifend. Aliquam malesuada nisl vitae cursus aliquam. Sed nec tristique dui. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla vitae elit dictum, rutrum lorem ut, venenatis lacus. Donec pharetra diam sit amet nisl tincidunt pharetra et at libero. In consequat, orci a pellentesque luctus, sapien urna finibus velit, eget posuere ligula tellus vel purus.</p>
<p>Nunc pharetra sollicitudin efficitur. Sed non pretium nibh, at ultrices risus. Nullam ut urna suscipit, pretium arcu ut, tempus turpis. Nam sollicitudin elit at libero convallis molestie. Etiam vel pretium augue. Donec vitae elit erat. Maecenas ac lacinia nisl. Phasellus id arcu eu nisi interdum ornare ac quis massa. Fusce a eleifend ipsum. Quisque rutrum id libero quis consequat. In elementum sed tellus consequat placerat.</p>
<p>Ut elementum dapibus egestas. Aliquam rutrum, lectus sed porttitor aliquet, felis nisl pulvinar quam, et dictum enim nisi quis velit. Proin scelerisque leo eu lectus consectetur vestibulum. Aenean suscipit lacus id tincidunt cursus. Praesent non rhoncus nunc. Phasellus porta ac quam in lobortis. Nam lacinia ex risus, non iaculis sem venenatis quis. Cras lacinia dolor vel urna porttitor dapibus. Mauris vel libero hendrerit, posuere neque in, porttitor enim. Aliquam non scelerisque massa. Donec non turpis quam. In eu tellus sodales, volutpat ante eu, molestie libero. Suspendisse potenti. Integer viverra nulla vel ligula ornare, a vestibulum enim tincidunt. Maecenas enim ex, suscipit vulputate pellentesque at, ullamcorper non purus.</p>
<p>Vivamus vel gravida lectus. Duis sit amet dui at arcu facilisis elementum. Fusce gravida leo enim, placerat finibus libero ultrices vitae. Aliquam id interdum mi. Nulla turpis orci, tempor non dictum eu, faucibus vitae dui. Duis vel quam quis sem viverra fringilla id vitae mi. Phasellus ac enim id sapien pharetra tincidunt nec nec felis. Praesent facilisis velit ac felis placerat tristique. Cras metus ante, aliquet quis dolor a, vehicula rutrum purus. Sed mollis, elit eu tempus varius, eros lorem porttitor tortor, eu fermentum erat diam semper odio. Nulla dictum turpis dignissim convallis feugiat. Mauris suscipit blandit aliquet.</p>
<p>Nunc eu nisl nulla. Nam fermentum scelerisque pellentesque. Donec at diam at ipsum feugiat vestibulum. Sed mollis finibus diam, vel pharetra sapien aliquam eget. Cras placerat mi sapien, ac scelerisque libero lobortis porta. Quisque finibus pretium accumsan. Praesent commodo a leo pharetra accumsan. Pellentesque a congue ex.</p>

</section>

<section class="commentsSection">
    <h2 class="commentCount"><?php echo $numComments . ' '; ?>Comments</h2>
    <?php if (!isset($_SESSION['user'])) : ?>
        <p>Log in to leave a comment.</p>
    <?php endif; ?>
     
          
     <!-- Loop through the comments -->
     <?php foreach ($commentArray as $comment) : ?>
        <div class="comment">
            <!-- avatar linked to the user  -->
            <img src="assets/images/<?php echo $comment['userID'];?>icon.png" alt="avatar for user" class="usericon">
            <!-- User linked here -->
            <p class="usertitle"><?php echo $comment['userID'];?> says:</p>
            <p class="responseDate">
                <?php 
                    $commentDateFormatted = new DateTime($comment['commentDate']);
                    $commentDate = $commentDateFormatted->format('F, j, Y');
                    $commentTime = $commentDateFormatted->format('g:i a');
                    echo $commentDate . '<br>' . $commentTime; ?></p>
            <!-- Comment body -->
            <div class="commentBody">
                <?php echo addTags($comment['commentText']); ?>
            </div>   
                <?php if (isset($_SESSION['user'])) : ?>

                    <!-- Reply button if user is logged in -->
                    <form action="index.php" method="post" class="formBtns" id="showReplyForm">
                        <input type="hidden" name="action" value="showReplyForm">
                        <input type="submit" class="btn addReply" value="Reply">
                    </form>
                    <?php if ($showReplyForm == TRUE) : ?>
                        <div class="commentForm" id="replyForm">
                            <?php include 'replies/replyForm.php'; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Edit and delete buttons if user is logged in and same user as the commentor -->
                    <?php if ($_SESSION['user'] == $comment['userID']) : ?>
                        <form action="comments/index.php" method="post" class="formBtns" id="editComment">
                            <input type="hidden" name="action" value="editComment">
                            <input type="hidden" name="commentID" value="<?php echo $comment['commentID'];?>">
                            <input type="submit" class="btn editBtn" value="Edit">
                        </form>
                        
                        <form action="comments/index.php" method="post" class="formBtns" id="deleteComment">
                            <input type="hidden" name="action" value="deleteComment">
                            <input type="hidden" name="commentID" value="<?php echo $comment['commentID'];?>">
                            <input type="submit" class="btn deleteBtn" value="Delete">
                        </form>
                    <?php endif; ?>   
                <?php endif; ?>
        </div>  

        <!-- Check if there are replies to the comment ID; if so, show them. If not, just show the comment. -->

        <!-- List of replies per comment -->
        <?php
            $commentID = $comment['commentID']; 
            $replies = repliesByCommentID($commentID); 
            $numReplies = $replies[0];
            $replyArray = $replies[1];
        
            if ($numReplies != 0) : ?>
                <?php foreach ($replyArray as $reply) :?>
                    <div class="response">
                        <img src="assets/images/<?php echo $reply['userID'];?>icon.png" alt="avatar for user" class="usericon">
                        <p class="usertitle"><?php echo $reply['userID']; ?> says:</p>
                        <p class="responseDate"><?php 
                            $replyDateFormatted = new DateTime($reply['replyDate']);
                            $replyDate = $replyDateFormatted->format('F, j, Y');
                            $replyTime = $replyDateFormatted->format('g:i a');
                            echo $replyDate . '<br>' . $replyTime; ?></p>
                        <div class="commentBody">
                            <?php echo addTags($reply['replyText']); ?>
                        </div>
                            <?php if (isset($_SESSION['user']) && $_SESSION['user'] == $reply['userID']) : ?>
                                <form action="replies/index.php" method="post" class="formBtns" id="editReply">
                                    <input type="hidden" name="action" value="editReply">
                                    <input type="hidden" name="replyID" value="<?php echo $reply['replyID']; ?>">
                                    <input type="submit" class="editBtn btn" value="Edit">
                                </form>
                                <form action="replies/index.php" method="post" class="formBtns" id="deleteReply">
                                    <input type="hidden" name="action" value="deleteReply">
                                    <input type="hidden" name="replyID" value="<?php echo $reply['replyID']; ?>">
                                    <input type="submit" class="deleteBtn btn" value="Delete">
                                </form>
                            <?php endif; ?>
                    </div>
                <?php endforeach;
            endif;
    endforeach; ?>
    

<?php if (isset($_SESSION['user'])) : ?>
    <section class="commentForm">
        <?php include 'comments/commentForm.php'; ?>
    </section>
<?php endif; ?>

</section>

</main>

<?php include 'view/footer.php'; ?>