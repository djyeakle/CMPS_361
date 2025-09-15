<?php
// tester grade variable
$grade = 67;

// if else to test what the variable is
if ($grade >= 90) {
    echo "Your letter grade is an A because your grade is a " . $grade . "%.";
} else if ($grade >= 80) {
    echo "Your letter grade is a B because your grade is a " . $grade . "%.";
} else if ($grade >= 70) {
    echo "Your letter grade is a C because your grade is a " . $grade . "%.";
} else {
    echo "You're failing because your grade is " . $grade;
}

?>