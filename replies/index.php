<?php 

require('../model/database.php');
require('../model/repliesDB.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
     $action = filter_input(INPUT_GET, 'action');
     if ($action == NULL) {
          $action = 'getReplies';
     }
}

switch ($action) {
     case 'getReplies':
          $comments = allReplies();
          include('');
          break;

     case 'addReply':
          $user = filter_input(INPUT_POST, $_SESSION['username']);
          $now = new DateTime();
          $submitted = $now->format('Y-m-d h:i:s');
          $text = filter_input(INPUT_POST, 'text');

          addReply($user, $submitted, $text);
          header('Location: . ');
          break;

     case 'editReply':
          $replyID = filter_input(INPUT_POST, 'replyID', FILTER_VALIDATE_INT);
          $text = filter_input(INPUT_POST, 'text');
          $now = new DateTime();
          $updated = $now->format('Y-m-d h:i:s');

          editReply($replyID, $updated, $text);

          break;
     
     case 'deleteReply':
          $replyID = filter_input(INPUT_POST, 'replyID', FILTER_VALIDATE_INT);
          deleteReply($replyID);
          break;
}


?>