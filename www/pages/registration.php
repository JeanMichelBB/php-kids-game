<?php
    include('./components/components.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registration Page</title>
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
                        Register
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirm-password"
                                    name="confirm-password" required>
                            </div>
                            <div class="form-group">
                                <label for="first-name">First Name:</label>
                                <input type="text" class="form-control" id="first-name" name="first-name" required>
                            </div>
                            <div class="form-group">
                                <label for="last-name">Last Name:</label>
                                <input type="text" class="form-control" id="last-name" name="last-name" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="create">Create</button>
                            <button type="submit" class="btn btn-secondary" name="sign-in">Sign-In</button>
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
        const confirm_password = form.querySelector('#confirm-password');
        const first_name = form.querySelector('#first-name');
        const last_name = form.querySelector('#last-name');

        form.addEventListener('submit', (event) => {
            // Check if username already exists
            if (checkUsernameExists(username.value)) {
                alert('Sorry, this username already exists. Please, choose another one.');
                event.preventDefault();
                return;
            }

            // Check if passwords match
            if (password.value !== confirm_password.value) {
                alert('Sorry, you entered 2 different passwords.');
                event.preventDefault();
                return;
            }

            // Check if first name is not empty
            if (first_name.value.trim() === '') {
                alert('Sorry, your first name cannot be empty.');
                event.preventDefault();
                return;
            }

            // Check if last name does not start with a number
            if (/^\d/.test(last_name.value.trim())) {
                alert('Sorry, your last name cannot start with a digit or number.');
                event.preventDefault();
                return;
            }
        });

        function checkUsernameExists(username) {
            // Check if username already exists in the database
            // Return true if username exists, false otherwise
        }

    </script>
</body>

</html>