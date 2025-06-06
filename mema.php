<!DOCTYPE html>
<html>
<head>
    <title>Roman Numeral Calculator</title>
</head>
<body>

<?php
function romanToDecimal($roman) {
    $romans = array(
        'I' => 1,
        'V' => 5,
        'X' => 10,
        'L' => 50,
        'C' => 100,
        'D' => 500,
        'M' => 1000
    );

    $result = 0;
    $roman = strtoupper($roman);
    $length = strlen($roman);

    for ($i = 0; $i < $length; $i++) {
        $current_value = $romans[$roman[$i]];
        $next_value = ($i < $length - 1) ? $romans[$roman[$i + 1]] : 0;

        if ($current_value < $next_value) {
            $result -= $current_value;
        } else {
            $result += $current_value;
        }
    }

    return $result;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roman1 = $_POST['roman1'];
    $roman2 = $_POST['roman2'];
    $operation = $_POST['operation'];

    if (!empty($roman1) && !empty($roman2)) {
        $decimal1 = romanToDecimal($roman1);
        $decimal2 = romanToDecimal($roman2);

        switch ($operation) {
            case 'addition':
                $result = $decimal1 + $decimal2;
                break;
            case 'subtraction':
                $result = $decimal1 - $decimal2;
                break;
            case 'multiplication':
                $result = $decimal1 * $decimal2;
                break;
            case 'division':
                if ($decimal2 != 0) {
                    $result = $decimal1 / $decimal2;
                } else {
                    $result = "Division by zero error!";
                }
                break;
            default:
                $result = "Invalid operation!";
                break;
        }

        echo "<p>The result of $operation between $roman1 and $roman2 is $result.</p>";
    } else {
        echo "<p>Please enter both Roman numerals.</p>";
    }
}
?>

<form method="post">
    <label for="roman1">Enter the first Roman Numeral:</label>
    <input type="text" id="roman1" name="roman1"><br><br>
    <label for="roman2">Enter the second Roman Numeral:</label>
    <input type="text" id="roman2" name="roman2"><br><br>
    <label for="operation">Select an operation:</label>
    <select id="operation" name="operation">
        <option value="addition">Addition</option>
        <option value="subtraction">Subtraction</option>
        <option value="multiplication">Multiplication</option>
        <option value="division">Division</option>
    </select><br><br>
    <input type="submit" value="Calculate">
</form>

</body>
</html>
