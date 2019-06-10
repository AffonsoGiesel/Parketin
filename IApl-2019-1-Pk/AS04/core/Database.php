<?php
    // Connection configuration

    $host = 'localhost';
    $database = 'parketin';
    $user = 'root';
    $password = '';

    // Connection object

    $pdo = new PDO('mysql:dbname='.$database.';host='.$host.';charset=UTF8', $user, $password);
?>