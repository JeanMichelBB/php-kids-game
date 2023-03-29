<?php
    session_start();

    if(!isset($_SESSION['username'])) {
        header('Location: ../pages/login.php');
    }

    include_once('./components/components.php');
    include_once('../game/Game.php');
    
    const MAX_LIVES = 6;
    const MAX_LEVEL = 6;
    
    $livesUsed = isset($_SESSION['livesUsed']) ? $_SESSION['livesUsed'] : 0;
    $isGameOver = isset($_SESSION['game_fail']) || $livesUsed >= 6 ? true : false;
    $level = isset($_SESSION['level']) ? $_SESSION['level'] : 1;
    
    $game = new Game();

    if(!isset($_POST['submit-answer'])) {
        switch ($level) {
        case 1:
            $game->level1();
            break;
        case 2:
            $game->level2();
            break;
        case 3:
            $game->level1();
            break;
        case 4:
            $game->level2();
            break;
        case 5: 
            $inputMaxLength = 1;
            $game->level1();
            break;
        case 6:
            $game->level2();
            break;
        default:
            echo "Invalid level number.";
            break;
        }
    }
    if(isset($_POST['submit-answer'])) {
        $userInput = $_POST['answer'];
        $rightAnswer = explode(",",$_POST['right-answer']);
        if ($isGameOver) {
            $livesUsed = 0;
            $_SESSION['livesUsed'] = $livesUsed;
            $_SESSION['game_fail'] = 'Game over!';
            header('Location: ../pages/gameOver.php');
        }
        if ($game->checkAnswer($userInput, $rightAnswer)) {
            $_SESSION['level_success'] = 'You have successfully completed level ' . $level . '!';
            $_SESSION['level_fail'] = '';
            if ($level == MAX_LEVEL) {
                $_SESSION['level_success'] = '';
                $_SESSION['game_success'] = 'You have successfully completed the game!';
            }
            header('Location: level.php');
        } else {
            $livesUsed++;
            $_SESSION['livesUsed']++;
            $_SESSION['level_fail'] = 'You have failed level ' . $level . '!';
        }
    }

    if(isset($_POST['next-level']) && $level < MAX_LEVEL){
        $level++;
        $_SESSION['level'] = $level;
        $_SESSION['level_fail'] = '';
        $_SESSION['level_success'] = '';
        header('Location: level.php');
    }

    if(isset($_POST['try-again']) && !$isGameOver) {
        $_SESSION['level_fail'] = '';
        $_SESSION['level_success'] = '';
        header('Refresh:0');
    } elseif (isset($_POST['try-again']) && $livesUsed >= MAX_LIVES) {
        $_SESSION['level_fail'] = '';
        $_SESSION['level_success'] = '';
        $_SESSION['game_fail'] = 'Game over!';
        header('Location: ../pages/gameOver.php');
    }

?>
<!DOCTYPE html>
<html>

<head>
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
    <title>Level <?php echo $level; ?></title>
</head>

<body>
    <?php 
        if (isset($_SESSION['level_fail'])) {
            $failMessage = $_SESSION['level_fail'];
        }
        if (isset($_SESSION['game_fail'])) {
            $failMessage = $_SESSION['level_fail'];
        }
        if(isset($_SESSION['level_success'])) {
            $_SESSION['level_fail'] = '';
            $successMessage = $_SESSION['level_success'];
        }
        echo createHeader();
        echo createNav();
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
            <?php
                if ($failMessage) {
                    echo "<div class='alert alert-dismissible alert-danger mt-3 d-flex'>
                                $failMessage
                                <form action=\"level.php\" method=\"post\">
                                    <button type=\"submit\" class=\"level-btn alert-link\" name=\"try-again\">Try again</button>
                                </form>
                            </div>";
                } if($successMessage) {
                    echo "<div class='alert alert-dismissible alert-success mt-3 d-flex'>
                                $successMessage
                                <form action=\"level.php\" method=\"post\">
                                    <input type=\"submit\" class=\"level-btn alert-link\" name=\"next-level\" value='Next Level' />
                                </form>
                            </div>";
                }
                ?>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <p class="mb-0"><b>Level <?php echo $level; ?></b>: <?php echo $game->message; ?></p>
                        <p class="mb-0"><b>Lives:</b> <?php echo MAX_LIVES - $livesUsed . "/" . MAX_LIVES; ?></p>
                    </div>
                    <div class="card-body px-5">
                        <form action="level.php" method="post">
                            <div class="form-group">
                                <label for="inputText" class="form-row justify-content-around">
                                    <?php
                                        foreach ($game->output as $card) {
                                            echo '<span class="rounded font-weight-bold border p-2 bg-light text-center" style="width: 38px; height: 38px">' .$card . "</span>";
                                        }
                                    ?>
                                </label>
                                <div class="form-row justify-content-around">
                                    <?php
                                    for($i = 0; $i < count($game->answer); $i++) {
                                        echo "<input required maxlength=\"$game->inputMaxLength\" type='text' class='form-control text-center col-md-1' name='answer[]' >";
                                    }
                                    ?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" <?php echo !$game->output ? 'disabled' : ''; ?> name="submit-answer">Submit</button>
                            <input type="hidden" name="right-answer" value="<?php echo implode(",",$game->answer); ?>">
                        </form>

                        <div class="mt-3">
                            <p id="result"></p>
                        </div>
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
</body>
</html>