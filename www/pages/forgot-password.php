<?php
    include('./components/components.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <?php 
        $isLoggedIn = FALSE; // TODO - Change this to TRUE when the user is logged in
        createHeader();
        createNav($isLoggedIn);
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Forgot Password
                    </div>
                    <div class="card-body">
                        <form method="POST" action='../helpers/auth.php'>
                            <div class="form-group">
                                <label for="existing-username">Existing Username:</label>
                                <input type="text" class="form-control" id="existing-username" name="existing-username"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="new-password">New Password:</label>
                                <input type="password" class="form-control" id="new-password" name="new-password"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="confirm-new-password">Confirm New Password:</label>
                                <input type="password" class="form-control" id="confirm-new-password"
                                    name="confirm-new-password" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="modify">Modify</button>
                            <a href="login.php" class="btn btn-secondary" name="Sign-In">Sign-In</a>
                        </form>
                    <?php
                        if (isset($_GET['error'])) {
                            $error_message = $_GET['error'];
                            echo "<div class='alert alert-danger mt-3'>$error_message</div>";
                        }
                        if (isset($_GET['success'])) {
                            $success_message = $_GET['success'];
                            echo "<div class='alert alert-success mt-3'>$success_message</div>";
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php createFooter(); ?>
    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- <script>
        const form = document.querySelector('form');
        const existingUsername = form.querySelector('#existing-username');
        const newPassword = form.querySelector('#new-password');
        const confirmNewPassword = form.querySelector('#confirm-new-password');

        form.addEventListener('submit', (event) => {
            // Check if existing username is correct
            if (!checkExistingUsername(existingUsername.value)) {
                alert('Sorry, the existing username you entered is incorrect!');
                event.preventDefault();
                return;
            }

            // Check if new password and confirm new password are the same
            if (newPassword.value !== confirmNewPassword.value) {
                alert('Sorry, the new password and confirm new password fields do not match!');
                event.preventDefault();
                return;
            }

            // Modify password
            modifyPassword(existingUsername.value, newPassword.value);

            // Redirect to login page
            window.location.href = 'login.html';
        });

        function checkExistingUsername(username) {
            // Check if existing username is correct
            // Return true if username is correct, false otherwise
        }

        function modifyPassword(username, password) {
            // Modify password for given username
        }

    </script> -->
</body>

</html>