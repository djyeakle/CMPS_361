<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();

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
    $result = pg_query_params($conn, $sql, array($username));

    if (pg_num_rows($result) > 0) {
        $user = pg_fetch_assoc($result);

        if (hash_equals($user['password'], crypt($password, $user['password']))) {
            $_SESSION['username'] = $username;
            header("Location: home.php");
        } else {
            echo "Invalid Password";
        }
    } else {
        echo "Invalid Username";
    }

    pg_close($conn);
?>