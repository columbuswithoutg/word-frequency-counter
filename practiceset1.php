<!DOCTYPE html>
<html>
<body>

<?php
function total_price(float $num1, float $num2, float $num3): float {
return $num1 + $num2 + $num3;
}
/**
* Add three numbers and return the result.
*
* @param float $num1 The first number.
* @param float $num2 The second number.
* @param float $num3 The third number.
* @return float The sum of $num1, $num2, and $num3.
*/

$total = total_price(10, 15, 20);
echo "Total price: $" . $total;

// Perform a series of string manipulations
function lowercased_string(string $sentence): string {
return strtolower(str_replace(' ', '', $sentence));
}
/**
* Remove the spaces and lowercase the sentence then return the result
*
* @str_replace ' ' with '' to remove the spaces.
* @strtolower to lowercase the sentence.
* @return string the result.
*/

$string = lowercased_string("This is a poorly written program with little
structure and readability.");
echo "\nModified string: " . $string;


function check_if_odd_or_even(float $number): string {
if ($number % 2 == 0) {
return "\nThe number " . $number . " is even.";
} else {
echo "\nThe number " . $number . " is odd.";
}
}
/**
* Checks if the number is odd or even
* You set the parameter as float since you plan to receive a number/float
* But set the return type to string since you're planning to return a sentence/string
* Use if/else statement to check if the number is odd or even then return the result with its corresponding sentence
*/

$result = check_if_odd_or_even(42);
echo $result;
// Check if a number is even or odd
?>
</body>
</html>
