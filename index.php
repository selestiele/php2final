<?php 

// Start session if one hasn't already been started
if (!isset($_SESSION)) {
    session_start();
}

// Get the database files
require('model/database.php');
require('model/commentsDB.php');
require('model/repliesDB.php');
require('admin/logout.php');
require('util/paths.php');
require('util/tags.php');


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'viewOnly';
    }
}

// Peform the specified action

switch($action) {
    case 'viewOnly':
        //get the comments
        $comments = allComments(); //returns a multidimensional array with the number of affected rows in first index and the comments array in the second index
        $numComments = $comments[0];
        $commentArray = $comments[1];
        //get the replies by comment
        foreach ($commentArray as $comment) {
            $commentID = $comment['commentID'];
        }
        $replies = repliesByCommentID($commentID); // same as with comments
        $numReplies = $replies[0];
        $replyArray = $replies[1];
        $authMessage = "";
        include 'post.php';
        break;
    
    case 'logout':
        $_SESSION = array();
        session_destroy();
        $authMessage = 'You have been logged out.';
        include 'post.php';
        break;    
    




}

 
?>
