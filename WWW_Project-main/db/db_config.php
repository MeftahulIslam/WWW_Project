<?php 
//setting up connection with database
    $host = '127.0.0.1:3306';
    $db = 'www_project';
    $user = "root";
    $pass = "";
    $charset = "utf8mb4";

    $dsn = "mysql:host=$host; dbname=$db; charset=$charset;";

    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage());
    }
                            //make objects of the two classes for further use
    require_once 'crud.php';
    require_once 'user.php';

    $crud = new crud($pdo);
    $userNew = new user($pdo);
?>