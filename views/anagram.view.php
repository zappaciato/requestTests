<?php

require '../vendor/autoload.php';

use Kris\TestProject\Classes\Request;
use Kris\TestProject\Classes\Database;
use Kris\TestProject\Classes\DefinedVaribles;
use Kris\TestProject\Classes\MathClasses\Anagram;
use Kris\TestProject\Classes\MathClasses\Circle;
use Kris\TestProject\Classes\MathClasses\Rectangle;


//-----------------ANAGRAM EXERCISE-----------------//


// print_r($_SERVER['REQUEST_METHOD']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $wordOne = $_POST["wordOne"];
    $wordTwo = $_POST["wordTwo"];
}

$anagramWords = new Anagram($wordOne, $wordTwo);
$diff = $anagramWords->displayAnagramResults();
$resultMessage = $diff ? " NOT ANAGRAMS" : " PERFECT ANAGRAMS";

//----------------END OF ANAGRAM EXERCISE ------------------------//



?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">

                <div class="row">
                    
                    <h1>------------------------ANAGRAM EXERCISE------------------------------------- <h1>
                            <div>
                                <h4>Check if this is an anagram:</h4>
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <input type="text" name="wordOne" placeholder="word one">
                                    <input type="text" name="wordTwo" placeholder="word two">
                                    <input type="submit" value="Submit">
                                </form>
                                <h4>This is the generic message: <?php echo $resultMessage ?></h4>
                                <h4>The word <?php echo " \"" . $wordOne . "\"" ?> and the word <?php echo " \"" . $wordTwo  . "\"" ?> are: </h4>
                                <h3><?php echo $resultMessage ?></h3>
                                <h5>The difference is: </h5>
                                <table>
                                    <tr>
                                        <?php
                                        if (!$diff == null || !$diff < 1) {
                                            foreach ($diff as $missingMatches) {
                                        ?>
                                                <td>
                                                    <?php
                                                    echo $missingMatches;
                                                    ?>
                                                </td>
                                    </tr>
                                </table>
                            <?php
                                            }
                                        } else {
                            ?>
                            <h5>There are no differences between the two words. </h5>
                        <?php
                                        }
                        ?>
                            </div>
                </div>
    </div>
</body>

</html>