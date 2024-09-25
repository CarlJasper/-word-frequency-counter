<?php
// Sample data
$items = [
    ['name' => 'Widget A', 'price' => 10],
    ['name' => 'Widget B', 'price' => 15],
    ['name' => 'Widget C', 'price' => 20],
];
/**
 * Calculates the total price of items in a shopping cart.
 *
 * @param array $items Array of items with 'name' and 'price' keys.
 * @return float Total price of the items.
 */
function calculateTotalPrice(array $items): float {
    $total = 0;
    foreach ($items as $item) {
        $total += $item['price'];
    }
    return $total;
}

/**
 * Modifies a string by removing spaces and converting to lowercase.
 *
 * @param string $input String to be modified.
 * @return string Modified string.
 */
function modifyString(string $input): string {
    $input = str_replace(' ', '', $input);
    return strtolower($input);
}

/**
 * Checks if a number is even or odd.
 *
 * @param int $number The number to check.
 * @return string Message indicating if the number is even or odd.
 */
function checkEvenOrOdd(int $number): string {
    return $number % 2 === 0 ? "The number $number is even." : "The number $number is odd.";
}

// Calculate total price
$totalPrice = calculateTotalPrice($items);
echo "Total price: $$totalPrice\n";

// Modify string
$originalString = "This is a poorly written program with little structure and readability.";
$modifiedString = modifyString($originalString);
echo "Modified string: $modifiedString\n";

// Check number
$number = 42;
echo checkEvenOrOdd($number);
?>
