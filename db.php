<?php
try {
    $user="admin";
    $pass="adminImmobilier";
    $pdo = new PDO('mysql:host=database-3.c646csheukgs.us-east-2.rds.amazonaws.com;dbname=biblio;charset=utf8', $user, $pass);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}
catch(Exception $e) {
    echo 'Exception -> ';
    var_dump($e->getMessage());
}