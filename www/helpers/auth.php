<?php

if (isset($_POST['connect'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    if (checkCredentials($username, $password)) {
        header('Location: ../pages/level.php');
    } else {
        $error_message = "Sorry, you entered a wrong username!";
        header("Location: ../pages/login.php?error=" . urlencode($error_message));
        }
}

function checkCredentials($username, $password){
    // TODO: replace with database
    $admin = 'admin';
    $adminPassword = 'admin';
    if ($username == $admin && $password == $adminPassword) {
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
            header("Location: ../pages/forgot-password.php?success=" . urlencode($success_message));
        } else {
            $error_message = "Sorry, the new password and confirm new password fields do not match!";
            header("Location: ../pages/forgot-password.php?error=" . urlencode($error_message));
        }
    } else {
        $error_message = "Sorry, the existing username you entered is incorrect!";
        header("Location: ../pages/forgot-password.php?error=" . urlencode($error_message));
    }
}

function checkExistingUsername($existingUsername){
    // TODO: replace with database
    $admin = 'admin';
    if ($existingUsername == $admin) {
        return true;
    } else {
        return false;
    }
}

function modifyPassword($existingUsername){
    // TODO: replace with database
    $admin = 'admin';
    $adminPassword = 'admin';
    if ($existingUsername == $admin) {
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
            header("Location: ../pages/registration.php?success=" . urlencode($success_message));
        } else {
            $error_message = "Sorry, the password and confirm password fields do not match!";
            header("Location: ../pages/registration.php?error=" . urlencode($error_message));
        }
    } else {
        $error_message = "Sorry, the username you entered is already taken!";
        header("Location: ../pages/registration.php?error=" . urlencode($error_message));
    }
}

function checkUsername($username){
    // TODO:replace with database
    $admin = 'admin';
    if ($username == $admin) {
        return false;
    } else {
        return true;
    }
}

function createAccount($username, $password, $firstName, $lastName){
    // TODO: replace with database
    $admin = 'admin';
    $adminPassword = 'admin';
    if ($username == $admin) {
        return true;
    } else {
        return false;
    }
}