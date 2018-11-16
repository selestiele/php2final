<?php 
// Start session if one hasn't already been started
if (!isset($_SESSION)) {
     session_start();
} 

require('../model/database.php');
require('../model/repliesDB.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
     $action = filter_input(INPUT_GET, 'action');
     // if ($action == NULL) {
     //      $action = 'getReplies';
     // }
}

switch ($action) {
     // case 'getReplies':
     //      $comments = allReplies();
     //      include('');
     //      break;

     case 'addReply':
          $user = filter_input(INPUT_POST, 'userID');
          $commentID = filter_input(INPUT_POST, 'commentID');
          $now = new DateTime();
          $submitted = $now->format('Y-m-d h:i:s');
          $text = filter_input(INPUT_POST, 'replyText');

          addReply($user, $submitted, $commentID, $text);
          
          header('Location: ../index.php ');
          break;

     case 'editReply':
          $replyID = filter_input(INPUT_POST, 'replyID', FILTER_VALIDATE_INT);
          $text = editReply($replyID);
          
          include 'editReply.php';
          break;

     case 'updateReply':
          $replyID = filter_input(INPUT_POST, 'replyID', FILTER_VALIDATE_INT);
          $text = filter_input(INPUT_POST, 'replyText');
          $now = new DateTime();
          $updated = $now->format('Y-m-d h:i:s');

          updateReply($replyID, $updated, $text);          
          header("Location: .. ");
          break;
     
     case 'deleteReply':
          $replyID = filter_input(INPUT_POST, 'replyID', FILTER_VALIDATE_INT);
          deleteReply($replyID);

          header("Location: .. ");
          break;
}


?>