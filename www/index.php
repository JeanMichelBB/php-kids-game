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
?>
