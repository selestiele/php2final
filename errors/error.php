<?php 
require_once('../model/util.php');
include '../view/header.php'; ?>
<div id="main">
    <h1 class="top">Error</h1>
    <p class="first_paragraph"><?php echo $error; ?></p>
    <p>
        <?php for ($i = 0; $i < 4; $i++):
            echo $errors[$i] . "<br>";
        endfor; ?> 
    </p>
    <a href="<?php echo $appPath ?>">Back to Home</a>
</div>
<?php include '../view/footer.php'; ?>