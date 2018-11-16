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

function addReply($user, $submitted, $commentID, $text) {
     global $db;
     $query = 'INSERT INTO replies (replyText, userID, replyDate, commentID)
               VALUES (:text, :user, :submitted, :commentID)';
     $statement = $db->prepare($query);
     $statement->bindValue(':user', $user);
     $statement->bindValue(':submitted', $submitted);
     $statement->bindValue(':text', $text);
     $statement->bindValue(':commentID', $commentID);
     $statement->execute();
     $statement->closeCursor();

}


function editReply($replyID) {
     //call forth the reply to edit from the database
     global $db;
     $query = 'SELECT replyText FROM replies
               WHERE replyID = :replyID';
     $statement = $db->prepare($query);
     $statement->bindValue(':replyID', $replyID);
     $statement->execute();
     $reply = $statement->fetch();
     $statement->closeCursor();
     return $reply;
}


function updateReply($replyID, $updated, $text) {
     global $db;
     $query = 'UPDATE replies
               SET replyText = :text,
               replyDate = :updated
               WHERE replyID = :replyID';
     $statement = $db->prepare($query);
     $statement->bindValue(':replyID', $replyID);
     $statement->bindValue(':text', $text);
     $statement->bindValue(':updated', $updated);
     $statement->execute();
     $statement->closeCursor();
}


function deleteReply($replyID) {
     global $db;
     $query = 'DELETE FROM replies
               WHERE replyID = :replyID';
     $statement = $db->prepare($query);
     $statement->bindValue(':replyID', $replyID);
     $statement->execute();
     $statement->closeCursor();
}


?>