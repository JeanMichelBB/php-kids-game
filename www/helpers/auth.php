<?php
session_start();
include_once('../db/db.php');

/**
 * Check the user credentials from the database
 * @param $username
 * @param $password
 * @return bool
 */
function checkCredentials($username, $password){
    $select = new SelectRowFromTable();

    if($select->selectFromPlayerAuth($username, $password)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Check if the username exists in the database
 * @param $existingUsername
 * @return bool
 */
function checkExistingUsername($existingUsername){
    $select = new SelectRowFromTable();
    $player = $select->selectFromPlayer($existingUsername);

    if ($existingUsername == $player['userName']) {
        return true;
    } else {
        return false;
    }
}

/**
 * Modify the password of the user
 * @param $existingUsername
 * @param $newPassword
 * @return bool
 */
function modifyPassword($existingUsername, $newPassword){
    $select = new SelectRowFromTable();
    $player = $select->selectFromPlayer($existingUsername);

    $registrationOrder = $player['registrationOrder'];
    $update = new UpdateTable();
    $result = $update->updatePlayerAuth($registrationOrder, $newPassword);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

/**
 * Insert a new user in the database
 * @param $username
 * @param $password
 * @param $firstName
 * @param $lastName
 * @return bool
 */
function createAccount($username, $password, $firstName, $lastName){
    $insert = new InsertRowToTable();
    $result = $insert->insertNewPlayer($firstName, $lastName, $username, $password);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

/**
 * Validate the password
 * - Password must be at least 8 characters long
 * - Password must contain at least one uppercase letter, one lowercase letter, and one number
 * - Password must not contain any spaces
 * - Password must only contain letters and numbers
 * @param $password
 * @return string
 */
function validatePassword($password) {

    define("PASSWORD_LENGTH", 8);

    if (strlen($password) < PASSWORD_LENGTH) {
        return "Password must be at least " . PASSWORD_LENGTH . " characters long.";
    }
    if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).+$/', $password)) {
       return  "Password must contain at least one uppercase letter, one lowercase letter, and one number.";
    }
    if(preg_match('/\s/', $password)) {
        return "Password must not contain any spaces.";
    }
    if(preg_match('/[^a-zA-Z0-9]/', $password)) {
        return "Password must only contain letters and numbers.";
    }
    return "";
}

/**
 * Validate the username
 * - Username must be at least 8 characters long
 * - Username must not contain any spaces
 * - Username must only contain letters and numbers
 * - Username must not start with a number
 * - Username must not be duplicated
 * @param $username
 * @return string
 */
function validateUsername($username) {
    define("USERNAME_LENGTH", 8);

    if (preg_match('/\s/', $username)) {
        return "Sorry, the username must not contain any spaces.";
    }
    if (preg_match('/[^a-zA-Z0-9]/', $username)) {
        return "Sorry, the username must only contain letters and numbers.";
    }
    if(strlen($username) < USERNAME_LENGTH) {
        return "Sorry, the username must be at least " . USERNAME_LENGTH . " characters long.";
    }
    if (preg_match('/^[0-9]/', $username)) {
        return "Sorry, the username must not start with a number.";
    }
    if(checkExistingUsername($username)) {
        return "Sorry, the username already exists.";
    }
    return "";
}

/**
 * Validate the first name
 * - First name must not contain any spaces
 * - First name must only contain letters
 * @param $firstName
 * @return string
 */
function validateFirstName($firstName) {
    if (preg_match('/\s/', $firstName)) {
        return "Sorry, the first name must not contain any spaces.";
    }
    if (preg_match('/[^a-zA-Z]/', $firstName)) {
        return "Sorry, the first name must only contain letters.";
    }
    return "";
}

/**
 * Validate the last name
 * - Last name must not contain any spaces
 * - Last name must only contain letters
 * @param $lastName
 * @return string
 */

function validateLastName($lastName) {
    if (preg_match('/\s/', $lastName)) {
        return "Sorry, the last name must not contain any spaces.";
    }
    if (preg_match('/[^a-zA-Z]/', $lastName)) {
        return "Sorry, the last name must only contain letters.";
    }
    return "";
}

/**
 * Sanitize the data
 * - Remove unnecessary characters (extra space, tab, newline)
 * - Remove backslashes (\)
 * - Convert special characters to HTML entities
 * @param $data
 * @return string
 */
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Log in form
if (isset($_POST['connect'])) {
    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);

    if(empty($username) || empty($password)) {
        $error_message = "Please fill in all fields!";
        $_SESSION['login_error'] = $error_message;

        header("Location: ../pages/login.php");
    } elseif (checkCredentials($username, $password)) {
        $_SESSION['username'] = $username;

        unset($_SESSION['login_error']);

        header('Location: ../pages/level.php');
    } else {
        $error_message = "Sorry, you entered a wrong username or password!";
        $_SESSION['login_error'] = $error_message;

        header("Location: ../pages/login.php");
    }
}

// Log out
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: ../pages/login.php');
}

// Forgot password form
if (isset($_POST['modify'])) {
    $existingUsername = sanitize($_POST['existing-username']);
    $newPassword = sanitize($_POST['new-password']);
    $confirmNewPassword = sanitize($_POST['confirm-new-password']);

    if(empty($existingUsername) || empty($newPassword) || empty($confirmNewPassword)) {
        $error_message = "Please fill in all fields!";
        $_SESSION['update_error'] = $error_message;

        header("Location: ../pages/forgot-password.php");
    } elseif (checkExistingUsername($existingUsername)) {
        $validPassword = validatePassword($newPassword);
        
        if($validPassword != "") {
            $error_message = $validPassword;
            $_SESSION['update_error'] = $error_message;

            header("Location: ../pages/forgot-password.php");
        } else {
            if ($newPassword == $confirmNewPassword) {
                modifyPassword($existingUsername, $newPassword);
    
                $success_message = "Password successfully modified!";
                $_SESSION['update_success'] = $success_message;
                
                header("Location: ../pages/forgot-password.php");
            } else {
                $error_message = "Sorry, the new password and confirm new password fields do not match!";
                $_SESSION['update_error'] = $error_message;
    
                header("Location: ../pages/forgot-password.php");
            }
        }
    } else {
        $error_message = "Sorry, the username you entered is incorrect!";
        $_SESSION['update_error'] = $error_message;

        header("Location: ../pages/forgot-password.php");
    }
}

// Registration form
if (isset($_POST['create'])) {
    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);
    $confirmPassword = sanitize($_POST['confirm-password']);
    $firstName = sanitize($_POST['first-name']);
    $lastName = sanitize($_POST['last-name']);

    $emptyFields = empty($username) || empty($password) || empty($confirmPassword) || empty($firstName) || empty($lastName);
    $validUsername = validateUsername($username);

    if($emptyFields) {
        $error_message = "Please fill in all fields!";
        $_SESSION['reg_error'] = $error_message;

        header("Location: ../pages/registration.php");

    } elseif ($validUsername == '') { // valid username
        $errorFirstName = validateFirstName($firstName);
        $errorLastName = validateLastName($lastName);

        if($errorFirstName != '' || $errorLastName != '') {
            $error_message = $errorFirstName . " " . $errorLastName;
            $_SESSION['reg_error'] = $error_message;

            header("Location: ../pages/registration.php");
        } else { // valid first name and last name
            $errorPassword = validatePassword($password);

            if($errorPassword == '') {
                if ($password == $confirmPassword) {
                    createAccount($username, $password, $firstName, $lastName);
                    
                    $_SESSION['username'] = $username;
                    
                    header("Location: ../pages/login.php");
                } else { // password and confirm password do not match
                    $error_message = "Sorry, the password and confirm password fields do not match!";
                    $_SESSION['reg_error'] = $error_message;

                    header("Location: ../pages/registration.php");
                }
            } else { // invalid password
                $_SESSION['reg_error'] = $errorPassword;

                header("Location: ../pages/registration.php");
            }
        }
    } else { // invalid username
       
        $_SESSION['reg_error'] = $validUsername;

        header("Location: ../pages/registration.php");
    }
}
