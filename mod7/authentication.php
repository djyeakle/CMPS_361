<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die("Invalid request method.");
    }

    session_start();

    include '../mod11/functions/track_activity.php';

    //database configuration
    $host = 'localhost';
    $db = 'stats';
    $user = 'postgres';
    $pass = 'vbnmrno4';
    $port = '5432';

    //create connection to postgres
    $conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pass");

    //validate the connection works
    if (!$conn) {
        die("Connection failed: " . pg_last_error());
    }

    //get user account information
    $username = $_POST['username'];
    $password = $_POST['password'];

    //sql query
    $sql = "SELECT * FROM users WHERE username = $1";
    $result = pg_query_params($conn, $sql, [$username]);

    if ($result === false) {
        die("Query failed: " . pg_last_error($conn));
    }

    if (pg_num_rows($result) > 0) {
        $userData = pg_fetch_assoc($result);

        if(is_array($userData) && isset($userData['password'])) {
            if (hash_equals($userData['password'], crypt($password, $userData['password']))) {
                $_SESSION['username'] = $username;
                logActivity($username, 'login', 'Logged in successfully');
                header("Location: home.php");
            } else {
                logActivity($username, 'login', 'Failed login');
                echo "Invalid Password";
            }    
        } else {
            echo "Error fetching user data.";
        } 
    } else {
        echo "Invalid Username";
    }

    pg_close($conn);
?>