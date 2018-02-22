<?php
    $dsn = "mysql:host=localhost;dbname=product_directory";
    $username = 'root';
    $password = null;

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>