<?php 
// Start session if one hasn't already been started
if (!isset($_SESSION)) {
     session_start();
 }

require('../model/database.php');
require('../util/paths.php');

// function to validate a password in the database
function verifyPassword($user, $password) {
     global $db;
     $query = 'SELECT userPW FROM users
               WHERE userID = :user';
     $statement = $db->prepare($query);
     $statement->bindValue(':user', $user);
     $statement->execute();
     $row = $statement->fetch();
     $statement->closeCursor();
     $hash = $row['userPW'];
     return password_verify($password, $hash);
}


$user = filter_input(INPUT_POST, 'username');
$pw = filter_input(INPUT_POST, 'password');
$loggedIn = FALSE;
$authMessage = "";

$pwValidated = verifyPassword($user, $pw);

if ($pwValidated) {
     $_SESSION['verifiedUser'] = TRUE;
     $_SESSION['user'] = $user;
     header("Location: ../index.php");
} else {
     $authMessage = "Your username or password was incorrect.";
     include '../post.php';
}
?>