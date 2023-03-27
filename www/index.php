<?php
session_start();
include_once('./db/database_info.php');
include_once('./db/login_info.php');
include_once('./db/ManipulateDB.php');
include_once('./db/CreateDBAndTables.php');

// Create database and tables
$db = new CreateDBAndTables();
$db->creatDBTables();

if(!isset($_SESSION['username'])) {
    header('Location: ../pages/login.php');
    
} else {
    header('Location: ../pages/level.php');
}


// // Test Game -- Delete when everything is integrated
// include('./pages/Game.php');
// $game = new Game();
// if(!isset($_POST['submit'])) {
//     echo "Level 3";
//     $game->level3();
// }

// if(isset($_POST['submit'])) {
//     $userInput = trim($_POST['answer-lvl3']);
//     $rightAnswer = $_POST['right-answer'];

//     echo $game->checkAnswer($userInput, $rightAnswer) ? 'User passes the level' : 'User fails the level';
// }


?>
