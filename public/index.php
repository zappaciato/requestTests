<?php

require '../vendor/autoload.php';

use Kris\TestProject\Classes\Request;
use Kris\TestProject\Classes\Database;
use Kris\TestProject\Classes\DefinedVaribles;
use Kris\TestProject\Classes\MathClasses\Anagram;
use Kris\TestProject\Classes\MathClasses\Circle;
use Kris\TestProject\Classes\MathClasses\Rectangle;


//REQUEST CLASS
// $url = "https://www.google.co.uk/search?q=cow";
$url = 'https://jsonplaceholder.typicode.com/todos/1';
// $url = '';
$httpMethod = "POST";



// $firstRequest = new Request();
// $firstRequest->url = $url;
// $firstRequest->httpMethod = $httpMethod;
// $firstRequest->updatePort();
// $firstRequest->displayCurrentData();
// $firstRequest->port = $firstRequest->updatePort($url);


// try {
//     $firstRequest->sendRqs();
// } catch (Exception $e) {
//     echo $e->getMessage();
// }

//DataBase connection (retrieve, add)

// $db_connection_credentials = DefinedVaribles::DB_DATA;

// // $host = $db_connection_credentials['host'];
// // $user = $db_connection_credentials['user'];
// // $pwd =  $db_connection_credentials['pwd'];
// // $db_name = $db_connection_credentials['db_name'];

// try {
//     $instance = Database::getInstance();
//     var_dump($instance);
//     $db_link = $instance->getConnection();
//     var_dump($db_link);
//     echo "Weszlo";
// } catch (Exception $e) {
//     // print_r($e);
//     echo "Nie weszło";
// }

// $sqlSelect = "SELECT * from users";
// $resultOutput = $db_link->query($sqlSelect);
// $row = [];

// if ($resultOutput->num_rows > 0) {
//     // fetch all data from db into array 
//     $row = $resultOutput->fetch_all(MYSQLI_ASSOC);
// }
// print_r($row);

// $newUserCredentials = [
//     'user_name' => "Michael Duddikoff",
//     'email_addres' => "mDudi@gmail.com",
//     'password' => "jfw8fjh3208848fh828f84hf",
// ];
// $user_name = "Michvdeesfsdagdfgel Duddikoff";
// $email_addres = "mDuffsdwegfdsddi@gmail.com";
// $password = "jfw8ffsefsdwgdfedjh3208848fh828f84hf";

// $sqlQuery2 = "INSERT INTO users (name, email, password) VALUES ($user_name, $email_addres, $password);";// To jest zly zapis do MariaDB
//  $sqlInsert = "INSERT INTO users " . "(name, email, password) " . "VALUES" . "('$user_name','$email_addres','$password')";
// // '$newUserCredentials['user_name']','$newUserCredentials['email_addres']','$newUserCredentials['password']'
// if($db_link->query($sqlInsert) === true) {
//     echo "New Recodrd has been added successfully";

// } else {
//     echo "Error: " . $sqlInsert . "<br>" . $db_link->error;
// }

//End of DB connection testing; 


// testing math classes

// $rectagnle = new Rectangle(23, 45);
// $rectagnle->calcArea();
// echo "Pole prostokata: " . $rectagnle->calcArea();
// echo "Obwód prostokata: " . $rectagnle->calcPerimeter();

// MATH EXERCISE: CIRCLE
// $radius = 33;
// $circle = new Circle(23);
// echo "Pole koła: " .
//     $circle->calcPerimeter();
// echo "Obwód koła: " .
//     $circle->calcArea();

// $rectagnle->displayResult('rectange', 'area', $rectagnle->calcArea());


//-----------------ANAGRAM EXERCISE-----------------//


$db_connection_credentials = DefinedVaribles::DB_DATA;

// $host = $db_connection_credentials['host'];
// $user = $db_connection_credentials['user'];
// $pwd =  $db_connection_credentials['pwd'];
// $db_name = $db_connection_credentials['db_name'];

try {
    $instance = Database::getInstance();
    var_dump($instance);
    $db_link = $instance->getConnection();
    var_dump($db_link);
    echo "Weszlo";
} catch (Exception $e) {
    // print_r($e);
    echo "Nie weszło";
}

    $wordOne = "TEST";
    $wordTwo = "TEST";

    // print_r($_SERVER['REQUEST_METHOD']);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $wordOne = $_POST["wordOne"];
        $wordTwo = $_POST["wordTwo"];
    }

    $anagramWords = new Anagram($wordOne, $wordTwo);
    $diff = $anagramWords->displayAnagramResults();
    $resultMessage = $diff ? " NOT ANAGRAMS" : " PERFECT ANAGRAMS";
    echo "ANAAAAAAAAAGRAM WOOOOOORDS";
    print_r($anagramWords);
// Anangram enter into the db

$word_one = "wordOne";
$word_two  = "wordTwo";
$difference = "jfwhf";

// $sqlQuery2 = "INSERT INTO anagrams (wordOne, wordTwo, anagramResult, difference) VALUES ($word_one, $word_two, $resultMessage, $difference);";// To jest zly zapis do MariaDB
 $sqlInsert = "INSERT INTO anagrams " . "(wordOne, wordTwo, anagramResult, difference) " . "VALUES" . "('$wordOne','$wordTwo','$resultMessage', '$difference')";
// '$newUserCredentials['user_name']','$newUserCredentials['email_addres']','$newUserCredentials['password']'
if($db_link->query($sqlInsert) === true) {
    echo "New Recodrd has been added successfully";

} else {
    echo "Error: " . $sqlInsert . "<br>" . $db_link->error;
}

//----------------END OF ANAGRAM EXERCISE ------------------------//

// if (
//     $_SERVER["REQUEST_METHOD"] == "POST"
// ) {
//     // Retrieve form data
//     $radius = $_POST["radius"];
// }
// $radius = 33;
// $circle = new Circle($radius);
// echo "Pole koła: " .
//     $circlePerimeter = $circle->calcPerimeter();
// echo "Obwód koła: " .
//     $circleArea = $circle->calcArea();

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>---------------------MATH EXERCISE---------------------------- <h1>
                <div class="row">
                    <div class="">
                        <div> <img style="width: 200px; height: 200px;" src="../Files/images/circle.png" alt="circle"></div>
                        <div> <img style="width: 200px; height: 200px;" src="../Files/images/rect.jpg" alt="circle"></div>
                        <p>Input radius</p>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="text" name="radius">
                            <input type="submit" value="Submit">
                        </form>
                        <h1>This is the area of your circle: <?php // echo $circleArea 
                                                                ?></h1>
                        <h1>This is the perimeter of your circle: <?php //echo $circlePerimeter 
                                                                    ?></h1>
                        <div class="table-responsive">

                        </div>
                    </div>
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