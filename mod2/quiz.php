<html>
    <head>
        <!-- created the form for the user to enter a number test -->
    <form method="post">
            Enter a number: <input type="number" name="number"></br>
            <input type="submit" value="Submit">
        </form>
    </head>
</html>

<?php
// finds the user input and makes it an integer
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $number = $_POST['number'];
        $intNumber = (int)$number;
// checks to see if there is a remainder after dividing by two (0 means even)
        if ($intNumber % 2 == 0) {
            echo "Your number is even.";
        } else {
            echo "Your number is odd.";
        }
    }

?>