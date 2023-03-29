<?php
session_start();
include_once('../db/db.php');

if (isset($_POST['connect'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (checkCredentials($username, $password)) {
        $_SESSION['username'] = $username;
        header('Location: ../pages/level.php');
        $_SESSION['username'] = $username;
        unset($_SESSION['login_error']);
    } else {
        $error_message = "Sorry, you entered a wrong username or password!";
        $_SESSION['login_error'] = $error_message;
        header("Location: ../pages/login.php");
    }
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: ../pages/login.php');
}

function checkCredentials($username, $password){
    $select = new SelectRowFromTable();
    if($select->selectFromPlayerAuth($username, $password)) {
        return true;
    } else {
        return false;
    }
}


if (isset($_POST['modify'])) {
    $existingUsername = $_POST['existing-username'];
    $newPassword = $_POST['new-password'];
    $confirmNewPassword = $_POST['confirm-new-password'];
    if (checkExistingUsername($existingUsername)) {
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
    } else {
        $error_message = "Sorry, the username you entered is incorrect!";
        $_SESSION['update_error'] = $error_message;
        header("Location: ../pages/forgot-password.php");
    }
}

function checkExistingUsername($existingUsername){
    $select = new SelectRowFromTable();
    $player = $select->selectFromPlayer($existingUsername);
    if ($existingUsername == $player['userName']) {
        return true;
    } else {
        return false;
    }
}

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

if (isset($_POST['create'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];

    if (checkUsername($username)) {
        if ($password == $confirmPassword) {
            createAccount($username, $password, $firstName, $lastName);
            $success_message = "Account successfully created!";
            $_SESSION['reg_success'] = $success_message;
            header("Location: ../pages/registration.php");
        } else {
            $error_message = "Sorry, the password and confirm password fields do not match!";
            $_SESSION['reg_error'] = $error_message;
            header("Location: ../pages/registration.php");
        }
    } else {
        $error_message = "Sorry, the username you entered is already taken!";
        $_SESSION['reg_error'] = $error_message;
        header("Location: ../pages/registration.php");
    }
}

function checkUsername($username){
    $select = new SelectRowFromTable();
    $player = $select->selectFromPlayer($username);

    if ($username == $player['userName']) {
        return false;
    } else {
        return true;
    }
}

function createAccount($username, $password, $firstName, $lastName){
    $insert = new InsertRowToTable();
    $result = $insert->insertNewPlayer($firstName, $lastName, $username, $password);

    if ($result) {
        return true;
    } else {
        return false;
    }


}