<?php

    $host = 'localhost';
    $port = '5432';
    $dbname = 'stats';
    $username = 'postgres';
    $password = 'vbnmrno4';

    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
        exit;
    }

    //logic
    if (isset($_POST['user_input'])) {
        $user_input = trim($_POST['user_input']);
        $stmt = $pdo->prepare("select answer from questions_answers_ where question ilike :question");
        $stmt->execute([':question' => '%' . $user_input . '%']);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        //conditional statement
        if ($result) {
            echo $result['answer'];
        } else {
            echo "Sorry, I do not know the answer to that.";
        }
    }

?>