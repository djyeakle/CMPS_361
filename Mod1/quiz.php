<html>
    <head>
    <form method="post">
            Enter a number: <input type="number" name="number"></br>
            <input type="submit" value="Submit">
        </form>
    </head>
</html>

<?php

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $number = $_POST['number'];
        $intNumber = (int)$number;

        if ($intNumber % 2 == 0) {
            echo "Your number is even.";
        } else {
            echo "Your number is odd.";
        }
    }

?>