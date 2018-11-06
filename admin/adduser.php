<?php 

require('../model/database.php');

$username = filter_input(INPUT_POST, 'userID');
$password = filter_input(INPUT_POST, 'password');
$hash = password_hash($password, PASSWORD_DEFAULT);

     global $db;
     $query = 'INSERT INTO users 
                    (userID, password) 
               VALUES
                    (:userID, :hash)';
     $statement = $db->prepare($query);
     $statement->bindValue(':userID', $username);
     $statement->bindValue(':hash', $hash);
     $success = $statement->execute();
     $statement->closeCursor();

$insertedID = $db->lastInsertId();

if ($success) {
     echo "<p>$insertedID was inserted into the database successfully.</p>";
} else {
     echo "<p>The user was not added to the database.</p>";
}



?>

<!DOCTYPE html>
<html lang="en">
     <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title></title>
          <meta name="description" content="">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="">
     </head>
     <body>
          <form action="adduser.php" method="post">
               <input type="text" name="userID" id="userID" placeholder="username">
               <input type="password" name="password" id="password" placeholder="password">
               <input type="submit" value="add me!">
          </form>
          
          
     </body>
</html>