<?php
session_start();
include_once('./db/database_info.php');
include_once('./db/login_info.php');
include_once('./db/ManipulateDB.php');
include_once('./db/CreateDBAndTables.php');
include_once('./db/InsertRowToTable.php');


// Create database and tables
$db = new CreateDBAndTables();
$db->creatDBTables();
// $insert = new InsertRowToTable();
// $insert->insertScore('failure', 6, 3 );

if(!isset($_SESSION['username'])) {
    header('Location: ../pages/login.php');
} else {
    header('Location: ../pages/level.php');
}


?>
