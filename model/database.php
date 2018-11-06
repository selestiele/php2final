<?php
    $dsn = 'mysql:host=localhost;dbname=php2final';
    //$dsn = 'mysql:host=noellepiercecom.ipagemysql.com;dbname=php2final';
    //$username = 'ebank';
    $username = 'root';
    $password = 'Taa;2tosbt';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>