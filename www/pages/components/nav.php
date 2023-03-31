<?php
function createNav()
{
    $username = '';
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    };
    if ($username) {
    return '<nav class="navbar navbar-expand-lg navbar-light bg-light" >
                <a class="navbar-brand" href="#"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="../pages/login.php">Login</a>
                        <a class="nav-link" href="../pages/registration.php">Registration</a>
                        <a class="nav-link" href="../pages/history.php">History</a>
                        <a class="nav-link" href="../pages/forgot-password.php">Forgot-password</a>
                    </div>
                    <div class="navbar-nav ml-auto">
                        <form action="../helpers/auth.php" method="POST">
                            <button type="submit" class="btn btn-primary" name="logout">Logout</button>
                        </form>
                    </div>
                </div>
            </nav>';
    } else {
        return '<nav class="navbar navbar-expand-lg navbar-light bg-light" >
                    <a class="navbar-brand" href="#"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="mx-auto text-center" id="navbarNavAltMarkup">
                        <div class="navbar-nav"> 
                            <div>Welcome to Kid\'s Game, sign in to play!</div>
                        </div>
                    </div>
                </nav>';
    }
}
