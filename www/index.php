<?php
// Define database connection constants
define('DB_HOST', 'db');
define('DB_USER', 'dw3');
define('DB_PASSWORD', 'dw3');
define('DB_NAME', 'dw3');

// Create MySQLi object
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Use the $mysqli object to execute queries and interact with the database

// Close connection
$mysqli->close();

// Test Game -- Delete when everything is integrated
include('./pages/Game.php');
$game = new Game();
if(!isset($_POST['submit'])) {
    echo "Level 3";
    $game->level3();
}

if(isset($_POST['submit'])) {
    $userInput = trim($_POST['answer-lvl3']);
    $rightAnswer = $_POST['right-answer'];

    echo $game->checkAnswer($userInput, $rightAnswer) ? 'User passes the level' : 'User fails the level';
}


?>
