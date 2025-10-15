<?php

    $host = 'localhost';
    $dbname = 'stats';
    $user = 'postgres';
    $pass = 'vbnmrno4';
    $port = 5432;
    
    try {
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

?>