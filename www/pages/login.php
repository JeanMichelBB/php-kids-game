<?php
    include('./components/components.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <?php 
        createHeader();
        createNav();
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <form method="post" action="/helpers/auth.php">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="connect">Connect</button>
                            <button type="submit" class="btn btn-secondary" name="sign-up">Sign-Up</button>
                        </form>

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
    <script>

        const form = document.querySelector('form');
        const username = form.querySelector('#username');
        const password = form.querySelector('#password');

        form.addEventListener('submit', (event) => {
            // Check if username and password are correct
            if (!checkCredentials(username.value, password.value)) {
                alert('Sorry, you entered a wrong username or password!');
                event.preventDefault();
                return;
            }

            // Start session and redirect to first level game
            startSession();
            window.location.href = 'first-level-game.html';
        });

        function checkCredentials(username, password) {
            // Check if username and password are correct
            // Return true if credentials are correct, false otherwise
        }

        function startSession() {
            // Start session
        }

    </script>
</body>

</html>