<!DOCTYPE html>
<html>
    <head>
        <title>Stats App Login</title>
        <link rel="stylesheet" href="./login.css">
        <script src="./popup.js"></script>
    </head>
    <body>
        <h2>Login</h2>
        <form action="authentication.php" method="post">
            <label for="username">Username: </label>
            <input type="text" name="username" required><br><br>

            <label for="password">Password: </label>
            <input type="password" name="password" required><br><br>

            <button type="submit" onclick=popup()>Login</button>
        </form>
    </body>
</html>
<?php

?>