<?php 


require('util/paths.php');
include 'view/header.php';

?>

<main class="page">
<h2>Thank you for visiting!</h2>
<p id="authMsg"><?php echo $authMessage; ?></p>

<p><a href="index.php">Logged out by mistake? Log back in.</a></p>

</main>

<?php include 'view/footer.php'; ?>
