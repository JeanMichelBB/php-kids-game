<?php
session_start();
$_SESSION['update_error'] = "";
$_SESSION['update_success'] = "";
$_SESSION['reg_error'] = "";
$_SESSION['reg_success'] = "";

include('./components/components.php');
if (isset($_SESSION['username'])) {
    header('Location: ../pages/level.php');
}
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
    if (isset($_SESSION['login_error'])) {
        $errorMessage = $_SESSION['login_error'];
    }
    echo createHeader();
    echo createNav();
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                if ($errorMessage) {
                    echo "<div class='alert alert-dismissible alert-danger fade show mt-3'>
                                $errorMessage
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                            </div>";
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>

                    <div class="card-body">
                        <form method="POST" action='../helpers/auth.php'>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <?php

                                if ($errorMessage) {
                                    // show forgot password link
                                    echo "<a href='forgot-password.php' class='btn btn-link'>Forgotten? Please, change your password.</a>";
                                }
                                ?>
                            </div>
                            <button type="submit" class="btn btn-primary" name="connect">Connect</button>
                            <a href="registration.php" class="btn btn-secondary" name="sign-up">Sign up</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo createFooter(); ?>
    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
    </script>
</body>

</html>