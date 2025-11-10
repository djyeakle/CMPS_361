<?php
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
    $result = pg_query_params($conn, $sql, [$username]);

    if ($result === false) {
        die("Query failed: " . pg_last_error($conn));
    }

    if (pg_num_rows($result) > 0) {
        $userData = pg_fetch_assoc($result);

        if(is_array($userData) && isset($userData['password'])) {
            if (hash_equals($userData['password'], crypt($password, $userData['password']))) {
                $_SESSION['username'] = $username;
                header("Location: home.php");
            } else {
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