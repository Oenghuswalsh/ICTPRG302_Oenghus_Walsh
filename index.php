<!DOCTYPE html>
<html lang="en">

<head>
    <title>Calculator APP in PHP</title>
    <!-- This is all the css style elements used to display this calculator app  -->
    <style>
        body {
            margin: 100px;
        }

        #calculator {
            background-color: red;
            display: block;
            width: 25vw;
            text-align: center;
            border: 2px solid black;
            border-radius: 4px;
            padding: 1rem;
            margin: 0 0.5rem 1rem;
        }

        label {
            font-size: 20px;
        }

        #firstNum,
        #secondNum,
        #result {
            text-align: center;
            font-size: 32px;
            width: fit-content;
        }
    </style>
    <!-- Below are the PHP vairables required for the calculator app.  -->
    <?php
    $firstNum = $_POST["firstNum"];
    $secondNum = $_POST["secondNum"];
    $operator = $_POST["operator"];
    $result = "";
    $equal = " = ";
    if ($secondNum == "0" && $operator == "/") {   #This is a Conditional statement to stop the dividing by 0 error.
        $result = " Dont divide by 0 ";
    } elseif (is_numeric($firstNum) && is_numeric($secondNum)) {  #This is a Conditional statement to check if the user has entered a numerical value.
        if ($operator == "+") {  #These Conditional statements output the result of the operator chosen by the user that is either + , - , * , / or reset.
            $result = $firstNum + $secondNum;
        } elseif ($operator == "-") {
            $result = $firstNum - $secondNum;
        } elseif ($operator == "*") {
            $result = $firstNum * $secondNum;
        } elseif ($operator == "/") {
            $result = $firstNum / $secondNum;
        } elseif ($operator == "reset") {
            $firstNum = "" & $operator = "" & $secondNum = "" & $result = "" & $equal = "";
        }
    }
    if ($_POST) {   #This is a function to write the contents of the calculatorLog to a file.
        file_put_contents("calculatorLog.txt", $_POST["calculatorLog"]);
    }   /*This is a function to get the contents of the calculatorLog.txt file.
    The calculatorLog.txt is a log of all the calcualtions preformed by the user.*/
    $fileToOpen = file_get_contents("calculatorLog.txt");
    ?>
</head>

<body>
    <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="POST" id="calculator">
        <h1>CALCULATOR</h1><br>
        <label for="firstnum">First number</label><br> <!-- This form is the structure of the calculator app  -->
        <input type="number" name="firstNum" id="firstNum" step="any" required value="<?php echo $firstNum; ?>"><br><br>
        <label for="secondNum">Second Number</label><br> <!-- These are the user input fields where we use the echo function to parse the value -->
        <input type="number" name="secondNum" id="secondNum" step="any" required value="<?php echo $secondNum; ?>"><br><br>
        <input type="submit" name="operator" value="+">
        <input type="submit" name="operator" value="-"> <!-- These are the user input fields to select the operator where we also use the echo function to parse the value -->
        <input type="submit" name="operator" value="*">
        <input type="submit" name="operator" value="/">
        <input type="submit" name="operator" value="reset"><br><br>
        <label for="result">Result</label><br>
        <input readonly name="result" id="result" step="any" value="<?php echo $result; ?>"><br><br><!-- The echo function is used to display the result of the calculation -->
        <!-- This textarea is a log of all the calculations by the user -->
        <textarea name="calculatorLog" id="calculatorLog" cols="40" rows="10"><?php echo ($firstNum . " " . $operator . " " . $secondNum . $equal . $result) . "\n"; ?>
        <?php echo $fileToOpen; ?> </textarea><br><br>
        <!-- I used the echo function to display the values and the operator the user has input and also the result
    when the user preforms the next calculation the previous entry is saved to the calculatorLog.txt file and moved to the next line in the textarea output. -->
    </form><br><br>
</body>

</html>