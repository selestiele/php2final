<?php 
if (!isset($_SESSION)) {
     session_start();
 } else if (isset($_SESSION)) {
     $user = $_SESSION['user'];
 }

require('util/paths.php');
include '../view/header.php';

?>

<main class="page">
<h2>Thank you for visiting!</h2>
<p id="authMsg"><?php echo $authMessage; ?></p>

</main>

<?php include '../view/footer.php'; ?>
