<?php
    session_start();
    unset($_SESSION['game_fail']);
    unset($_SESSION['game_success']);

    if(!isset($_SESSION['username'])) {
        header('Location: login.php');
    }

    include_once('./components/components.php');
    include_once('../game/Game.php');
    include_once('../db/db.php');
    include_once('../helpers/validation.php');

    const MAX_LIVES = 6;
    const MAX_LEVEL = 6;

    $livesUsed = isset($_SESSION['livesUsed']) ? $_SESSION['livesUsed'] : 0;
    $level = isset($_SESSION['level']) ? $_SESSION['level'] : 1;

    $game = new Game();
    $insert = new InsertRowToTable();

    // Display the correct level
    if(!isset($_POST['submit-answer'])) {
        switch ($level) {
        case 1:
            $game->level1();
            break;
        case 2:
            $game->level2();
            break;
        case 3:
            $game->level3();
            break;
        case 4:
            $game->level4();
            break;
        case 5: 
            $game->level5();
            break;
        case 6:
            $game->level6();
            break;
        default:
            $level = 1;
            $game->level1();
            break;
        }
    }
    // When the user submits an answer
    if(isset($_POST['submit-answer'])) {
        unset($_SESSION['input_error']);
        $userInput = $_POST['answer'];
        $rightAnswer = explode(",",$_POST['right-answer']);
        
        // Check if the user input is valid
        if($game->validateAnswer($userInput)) {
            // Check if the answer is correct
            if ($game->checkAnswer($userInput, $rightAnswer)) {

                // If the the level is the last one
                if ($level == MAX_LEVEL) {
                    unset($_SESSION['level_success']);
                    unset($_SESSION['level_fail']);

                    $_SESSION['game_success'] = 'You have successfully completed the game!';
                    $insert->insertScore('success', $livesUsed, $_SESSION['username']);

                    header('Location: ../pages/gameOver.php');
                } else { // If the level is not the last one
                    $_SESSION['level_success'] = 'You have successfully completed level ' . $level . '!';

                    unset($_SESSION['level_fail']);
                    header('Location: level.php');
                }
            } else { // If the answer is wrong
                $livesUsed++;
                $_SESSION['livesUsed'] = $livesUsed;
                // If the user has used all the lives
                if ($livesUsed >= MAX_LIVES) {
                    unset($_SESSION['level_fail']);
                    unset($_SESSION['level_success']);

                    $_SESSION['game_fail'] = 'You have failed the game!';
                    $insert->insertScore('failure', $livesUsed, $_SESSION['username']);
                    $livesUsed = 0;
                    $_SESSION['livesUsed'] = $livesUsed;

                    header('Location: ../pages/gameOver.php');
                } else { // If the user has not used all the lives
                    unset($_SESSION['level_success']);
                    $_SESSION['level_fail'] = 'You have failed level ' . $level . '!';
                }
            }
        } else { // If the user input is not valid
            header('Location: level.php');
        }
    }

    // When the user clicks on the next level button
    if(isset($_POST['next-level'])){
        $level++;
        $_SESSION['level'] = $level;
        unset($_SESSION['level_fail']);
        unset($_SESSION['level_success']);
        header('Location: level.php');
    } 
    // When the user clicks on the try again button
    if(isset($_POST['try-again'])) {
        unset($_SESSION['level_fail']);
        unset($_SESSION['level_success']);
        header('Refresh:0');
    }
    // When the user clicks on the give up button
    if(isset($_POST['give-up'])) {
        $_SESSION['game_fail'] = 'You have give-up the game!';
        $insert->insertScore('incomplete', $livesUsed, $_SESSION['username']);
        header('Location: ../pages/gameOver.php');
    }
    // If the user has failed the level set the fail message
    if (isset($_SESSION['level_fail'])) {
        $failMessage = $_SESSION['level_fail'];
    }
    // If the user has succeeded the level set the success message
    if(isset($_SESSION['level_success'])) {
        $successMessage = $_SESSION['level_success'];
        $game->output = [];
        $game->answer = [];
    }
    // If the user has an input error set the input error message
    if(isset($_SESSION['input_error'])) {
        $inputError = $_SESSION['input_error'];
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
        .myCard {
            width: 50px;
            height: 50px;
        }
        .vh-100 {
            height: 100vh;
        }
    </style>
    <title>Level <?php echo $level; ?></title>
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
                if (isset($failMessage)) {
                    echo "<div class='alert alert-dismissible alert-danger mt-3 d-flex'>
                                $failMessage
                                <form action=\"level.php\" method=\"post\">
                                    <button autofocus type=\"submit\" class=\"level-btn alert-link\" name=\"try-again\">Try again</button>
                                </form>
                            </div>";
                } if(isset($successMessage)) {
                    echo "<div class='alert alert-dismissible alert-success mt-3 d-flex'>
                                $successMessage
                                <form action=\"level.php\" method=\"post\">
                                    <input autofocus type=\"submit\" class=\"level-btn alert-link\" name=\"next-level\" value='Next Level' />
                                </form>
                            </div>";
                }
                if (isset($inputError)) {
                    echo "<div class='alert alert-dismissible alert-danger mt-3 d-flex'>
                                $inputError
                                <form action=\"level.php\" method=\"post\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                        <span aria-hidden=\"true\">&times;</span>
                                    </button>
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
                        <span>Level progress</span>
                        <div class="progress mb-4">
                            <?php
                            $progress = ($level - 1) * (100 / MAX_LEVEL);
                            $progress = round($progress);
                            echo "<div class='progress-bar' role='progressbar' style='width: $progress%' aria-valuenow='$progress' aria-valuemin='0' aria-valuemax='100'>$progress%</div>";
                            ?>
                        </div>
                        <form action="level.php" method="post">
                            <div class="form-group">
                                <label for="inputText" class="form-row justify-content-around">
                                    <?php
                                    foreach ($game->output as $card) {
                                        echo '<span class="rounded font-weight-bold border p-2 bg-light d-flex align-items-center justify-content-center myCard" >' . $card . "</span>";
                                    }
                                    ?>
                                </label>
                                <div class="form-row justify-content-around">
                                    <?php
                                    for ($i = 0; $i < count($game->answer); $i++) {
                                        echo "<input autofocus maxlength=\"$game->inputMaxLength\" type='text' class='form-control text-center col-md-1.5 myCard answer' name='answer[]' >";
                                    }
                                    ?>
                                </div>
                            </div>
                            <button type="submit" disabled class="btn btn-primary submitBt" <?php echo !$game->output ? 'disabled' : ''; ?> name="submit-answer">Submit</button>
                            <button type="submit" class="btn btn-danger float-right" name="give-up">Give-up</button>
                            <input type="hidden" name="right-answer" value="<?php echo implode(",", $game->answer); ?>">
                        </form>
                        <div class="mt-3">
                            <p id="result"></p>
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
    <script>
        const inputs = document.querySelectorAll('.answer');
        const submitBt = document.querySelector('.submitBt');
        const maxlength = <?php echo $game->inputMaxLength; ?>;
       
        inputs.forEach(input => {
            let allFilled = true;
            input.addEventListener('input', () => {
                // Check if all inputs are filled
                inputs.forEach(inpt => {
                    if (!inpt.value) {
                        allFilled = false;
                        return;
                    }
                });
                // Enable the submit button if all inputs are filled
                if (allFilled) {
                    submitBt.removeAttribute('disabled');
                } else {
                    submitBt.setAttribute('disabled', true);
                }
                // Moves the focus to the next input
                if (input.value.length === maxlength) {
                    input.nextElementSibling.focus();
                }
                if (input.value.length === 0) {
                    input.previousElementSibling.focus();
                }
            });
        });
        
    </script>
</body>
</html>