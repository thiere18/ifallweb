<?php
try {
    $user="root";
    $pass="test";
    $pdo = new PDO('mysql:host=db;dbname=biblio;charset=utf8', $user, $pass);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}
catch(Exception $e) {
    echo 'Exception -> ';
    var_dump($e->getMessage());
}