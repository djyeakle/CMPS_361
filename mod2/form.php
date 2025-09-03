<html>
    <head>
        <!-- creating the actual form so that the php can get input info -->
        <form method="post">
            Enter your name: <input type="text" name="username"></br>
            Enter your age: <input type="text" name="age"></br>
            <input type="submit" value="Submit">
        </form>
    </head>
</html>

<?php
// looking for the input info from the form to echo its information
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST['username'];
        $age = $_POST['age'];
        echo "Hello, $user! You are $age years old.";
    }

?>