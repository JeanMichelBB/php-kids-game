<?php
    session_start();
    if(!isset($_SESSION['username'])) {
        header('Location: ../pages/login.php');
    }
    include_once('./components/components.php');
    include_once('../game/Game.php');
    $_SESSION['livesUsed'] = 0;
    $_SESSION['level'] = 1;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Game over Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .level-btn {
            background-color: transparent;
            border: none;
        }
        .level-btn:hover {
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
    <title>Game Over</title>
</head>
<body>
    <?php 
        echo createHeader();
        echo createNav();
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                        <b>No more lives</b> <!--View your score-->
                        <a href="history.php" class=" float-right">View your score</a>
                    </div>
                    <div class="card-body px-5">
                        <div class="text-center">
                            <h1>Game Over</h1>
                        </div>
                    </div>
                </div>
            <?php
            echo "<div class='alert alert-dismissible alert-danger fade show mt-3'>
                    <form action=\"level.php\" method=\"post\">
                        <button type=\"submit\" class=\"level-btn alert-link\" name=\"try-again\">Try again</button>
                    </form>
                </div>"
                ?>
            </div>
        </div>
    </div>
    <?php echo createFooter(); ?>
    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>

