<?php 

require('../model/database.php');
require('../model/commentsDB.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
     $action = filter_input(INPUT_GET, 'action');
     // if ($action == NULL) {
     //      $action = 'getAllComments';
     // }
}

switch ($action) {
     // case 'getAllComments':
     //      $comments = allComments();
     //      include('');
     //      break;

     case 'addComment':
          $user = filter_input(INPUT_POST, 'userID');
          $now = new DateTime();
          $submitted = $now->format('Y-m-d h:i:s');
          $text = filter_input(INPUT_POST, 'commentText');

          addComment($user, $submitted, $text);
          header('Location: ../index.php ');
          break;

     case 'editComment':
     // this needs to be two cases--one to pull the comment from the database to edit, and one to submit the updates to the databse
          $commentID = filter_input(INPUT_POST, 'commentID', FILTER_VALIDATE_INT);
          $text = editComment($commentID);
          include 'editComment.php';
          break;

     case 'updateComment':
          $commentID = filter_input(INPUT_POST, 'commentID', FILTER_VALIDATE_INT);
          $text = filter_input(INPUT_POST, 'commentText');
          $now = new DateTime();
          $updated = $now->format('Y-m-d h:i:s');

          updateComment($commentID, $updated, $text);
          header("Location: .. ");
 
          break;
     
     case 'deleteComment':
          $commentID = filter_input(INPUT_POST, 'commentID', FILTER_VALIDATE_INT);
          deleteComment($commentID);
          header("Location: .. ");

          break;
}


?>