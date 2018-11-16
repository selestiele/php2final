<?php 

// Start session if one hasn't already been started
if (!isset($_SESSION)) {
    session_start();
} 



// Get the database files
require('model/database.php');
require('model/commentsDB.php');
require('model/repliesDB.php');
require('util/paths.php');
require('util/tags.php');

// This controller handles the logout and initial views 

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'viewOnly';
    }
}

// Perform the specified action

switch($action) {
    case 'viewOnly':
        //get the comments
        $comments = allComments(); //returns a multidimensional array with the number of affected rows in first index and the comments array in the second index
        $numComments = $comments[0];
        $commentArray = $comments[1];
        $authMessage = "";
        $showReplyForm = FALSE;
        include 'post.php';
        break;

    case 'showReplyForm':
        $showReplyForm = TRUE;
        $comments = allComments();
        $numComments = $comments[0];
        $commentArray = $comments[1];
        $authMessage = "";
        include 'post.php';
        
        break;
   
    case 'logout':
        $_SESSION = array();
        session_destroy();
        $authMessage = 'You have been logged out.';
        include 'logout.php';
        break;    
    




}

 
?>
