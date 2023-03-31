<?php
    session_start();
    if(!isset($_SESSION['username'])) {
        header('Location: ../pages/login.php');
    }
    if(!isset($_SESSION['game_fail']) && !isset($_SESSION['game_success'])) {
        header('Location: ../pages/level.php');
    }

    include_once('./components/components.php');
    include_once('../game/Game.php');
    
    unset($_SESSION['livesUsed']);
    unset($_SESSION['level']);
    unset($_SESSION['input_error']);

    $successMessage = isset($_SESSION['game_success']) ? $_SESSION['game_success'] : '';
    $failMessage = isset($_SESSION['game_fail']) ? $_SESSION['game_fail'] : '';

    if (isset($_POST['try-again'])) {
        unset($_POST['try-again']);
        header('Location: ../pages/level.php');
    }

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
        .vh-100 {
            height: 100vh;
        }
    </style>
    <title>Game Over</title>
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

                <div class="card <?php echo $successMessage ? 'alert-success' : 'alert-danger'?>">
                    <div class="card-body px-5">
                        <div class="text-center">
                            <?php
                                if ($successMessage) {
                                    echo '<h1>Congratulations!</h1>';
                                    echo '<p>' . $successMessage . '</p>';
                                } elseif ($failMessage) {
                                    echo '<h1> Ooops! </h1>';
                                    echo '<p>' . $failMessage . '</p>';
                                }
                            ?>
                             <form method="post" action="gameOver.php">
                                <button type="submit" class="level-btn alert-link" name="try-again">Try again</button>
                            </form>
                        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/js-confetti@latest/dist/js-confetti.browser.js"></script>
    <script>
        const jsConfetti = new JSConfetti()

        <?php
            if ($successMessage) {
                echo 'jsConfetti.addConfetti();';
            }
        ?>
    </script>
</body>

</html>

