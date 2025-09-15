<?php

    $host = "localhost";
    $port = "5432";
    $dbname = "closet";
    $user = "postgres";
    $password = "vbnmrno4";

    $dsn = "pgsql:host=$host;dbname=$dbname";

    try {
        $instance = new PDO($dsn,$user,$password);

        $instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Successfully connected to the database";

    } catch (PDOException $e) {
        echo "Connection Failed: " . $e->getMessage();
    }

?>