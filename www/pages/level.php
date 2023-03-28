<?php
    session_start();

    if(!isset($_SESSION['username'])) {
        header('Location: ../pages/login.php');
    }

    include_once('./components/components.php');
    include_once('../game/Game.php');

    $livesUsed = 0;
    define("MAX_LIVES", 6);
    $userOutput;
    $rightAnswer;
    $message;
    $inputMaxLength = 1;

    $game = new Game();

    if (isset($_SESSION['level'])) {
        $level = $_SESSION['level'];
    } else {
        $level = 1;
    }
    if(!isset($_POST['submit-level'])) {
        switch ($level) {
        case 1:
            $game->level1();
            $userOutput = $game->output;
            $rightAnswer = $game->answer;
            $message = $game->message;
            break;
        case 2:
            $game->level2();
            $userOutput = $game->output;
            $rightAnswer = $game->answer;
            $message = $game->message;
            break;
        case 3:
            $game->level3();
            $inputMaxLength = 2;
            break;
            case 4:
            $inputMaxLength = 2;
            $game->level4();
            break;
        case 5: 
            $inputMaxLength = 1;
            $game->level5();
            break;
        case 6:
            $inputMaxLength = 2;
            $game->level6();
            break;
        default:
            echo "Invalid level number.";
            break;
        }
    }
    if(isset($_POST['submit-level'])) {
        $userInput = $_POST['answer'];
        $rightAnswer = explode(",",$_POST['right-answer']);

        if ($game->checkAnswer($userInput, $rightAnswer)) {
            $_SESSION['level']++;
            header('Location: level.php');
        } else {
            $livesUsed++;
            $_SESSION['livesUsed']++;
            if ($livesUsed == MAX_LIVES) {
                header('Location: ../pages/gameover.php');
            }
        }
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
    <title>Level</title>
</head>

<body>
    <?php 
        $isLoggedIn = isset($_SESSION['username']);
        if (!$isLoggedIn) {
            header('Location: login.php');
        }
        createHeader();
        createNav();
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <b>Level <?php echo $level; ?></b>: <?php echo $message; ?>
                    </div>
                    <div class="card-body px-5">
                        <form action="level.php" method="post">
                            <div class="form-group">
                                <label for="inputText" class="form-row justify-content-around">
                                    <?php
                                        foreach ($userOutput as $letter) {
                                            echo '<span class="rounded font-weight-bold border p-2 bg-light text-center" style="width: 38px; height: 38px">' .$letter . "</span>";
                                        }
                                    ?>
                                </label>
                                <div class="form-row justify-content-around">
                                    <?php
                                    for($i = 0; $i < count($rightAnswer); $i++) {
                                        echo "<input maxlength=\"$inputMaxLength\" type='text' class='form-control col-md-1' name='answer[]' >";
                                    }
                                    ?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit-level">Submit</button>
                            <input type="hidden" name="right-answer" value="<?php echo implode(",",$rightAnswer); ?>">
                        </form>

                        <div class="mt-3">
                            <p id="result"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php createFooter(); ?>
</body>

</html>

