<?php
// This file will hold all the SQL queries for the comments table.


function allComments() {
     global $db;
     $query = 'SELECT * FROM comments
               ORDER BY commentDate DESC';
     $statement = $db->prepare($query);
     $statement->execute();
     $comments = $statement->fetchAll();
     $rows = $statement->rowCount();    
     $statement->closeCursor();
     return array($rows, $comments); 
}


function addComment($user, $submitted, $text) {
     global $db;
     $query = 'INSERT INTO comments (commentText, userID, commentDate)
               VALUES (:text, :user, :submitted)';
     $statement = $db->prepare($query);
     $statement->bindValue(':user', $user);
     $statement->bindValue(':submitted', $submitted);
     $statement->bindValue(':text', $text);
     $statement->execute();
     $statement->closeCursor();
}

function editComment($commentID) {
     //call forth the comment to edit from the database
     global $db;
     $query = 'SELECT commentText FROM comments
               WHERE commentID = :commentID';
     $statement = $db->prepare($query);
     $statement->bindValue(':commentID', $commentID);
     $statement->execute();
     $comment = $statement->fetch();
     $statement->closeCursor();
     return $comment;
}

function updateComment($commentID, $updated, $text) {
     //update comment where commentID = $commentID
     global $db;
     $query = 'UPDATE comments
               SET commentText = :text,
               commentDate = :updated
               WHERE commentID = :commentID';
     $statement = $db->prepare($query);
     $statement->bindValue(':commentID', $commentID);
     $statement->bindValue(':updated', $updated);
     $statement->bindValue(':text', $text);
     $statement->execute();
     $statement->closeCursor();
}

function deleteComment($commentID) {
     global $db;
     $query = 'DELETE FROM comments
               WHERE commentID = :commentID';
     $statement = $db->prepare($query);
     $statement->bindValue(':commentID', $commentID);
     $statement->execute();
     $statement->closeCursor();
}



?>