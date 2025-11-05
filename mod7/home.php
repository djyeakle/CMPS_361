<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Stats App Home</title>
        <link rel="stylesheet" href="./home.css">
        <script src="./home.js"></script>
    </head>
    <body>
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>You have successfully logged in.</p>
        <div class=buttonOptions>
            <button onclick=viewProducts()>View Products</button>
            <br>
            <button onclick=logout() class="logout">Logout</button>
        </div>
    </body>
</html>