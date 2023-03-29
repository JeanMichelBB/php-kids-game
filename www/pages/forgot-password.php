<?php
    session_start();
    unset($_SESSION['reg_error']);
    unset($_SESSION['reg_success']);
    unset($_SESSION['login_error']);
    unset($_SESSION['login_success']);
    
    include('./components/components.php');
    
    if (isset($_SESSION['update_error'])) {
        $errorMessage = $_SESSION['update_error'];
    }
    if(isset($_SESSION['update_success'])) {
        unset($_SESSION['update_error']);    
        $successMessage = $_SESSION['update_success'];
    }
?>
<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .vh-100 {
            height: 100vh;
        }
    </style>
</head>

<body class="vh-100 d-flex flex-column justify-content-between">
    <header>
        <?php
            echo createHeader();
            echo createNav();
        ?>
    </header>
    <article class="container">
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
                } if($successMessage) {
                    echo "<div class='alert alert-dismissible alert-success fade show mt-3'>
                                $successMessage
                                <a href=\"login.php\" class=\"alert-link\">Log in to your account</a>
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                            </div>";
                }
                ?>
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
                    </div>
                </div>
            </div>
        </div>
    </article>
    <?php echo createFooter(); ?>
    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>