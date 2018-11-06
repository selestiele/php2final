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
     $query = '';
     $statement = $db->prepare($query);
     $statement->bindValue(':user', $user);
     $statement->bindValue(':submitted', $submitted);
     $statement->bindValue(':text', $text);
     $statement->execute();
     $statement->closeCursor();
}

function editComment($commentID, $updated, $text) {
     //update comment where commentID = $commentID
}

function deleteComment($commentID) {
     global $db;
     $query = 'DELETE from comments
               WHERE commentID = :commentID';
     $statement = $db->prepare($query);
     $statement->bindValue(':commentID', $commentID);
     $statement->execute();
     $statement->closeCursor();
}



?>