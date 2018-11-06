<?php
// This file will hold all the SQL queries for the replies table.

function allReplies() {
     global $db;
     $query = 'SELECT * FROM replies r
               JOIN comments c ON r.commentID = c.commentID
               ORDER BY replyDate ASC';
     $statement = $db->prepare($query);
     $statement->execute();
     $replies = $statement->fetchAll(); 
     $numReplies = $statement->rowCount();   
     $statement->closeCursor();
     return array($numReplies, $replies); 
}

function repliesByCommentID($commentID) {
     global $db;
     $query = 'SELECT * FROM replies r
               WHERE commentID = :commentID
               ORDER BY replyDate ASC';
     $statement=$db->prepare($query);
     $statement->bindValue(':commentID', $commentID);
     $statement->execute();
     $replies = $statement->fetchAll();
     $numReplies = $statement->rowCount();
     $statement->closeCursor();
     return array($numReplies, $replies);

}

function addReply($user, $submitted, $text) {

}

function editReply($replyID, $updated, $text) {

}

function deleteReply($replyID) {
     
}


?>