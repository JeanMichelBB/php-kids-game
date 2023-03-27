
    <?php

    function createNav()
    { 
        $isLoggedIn = TRUE; // TODO - Change this to TRUE when the user is logged in
        if ($isLoggedIn == TRUE) {

            echo <<<EOT

        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 200px;"> <!-- TODO MARGIN bottom-->
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="../pages/login.php">Login</a>
                    <a class="nav-link" href="../pages/registration.php">Registration</a>
                    <a class="nav-link href="../pages/history.php">History</a>
                    <a class="nav-link" href="../pages/forgot-password.php">Forgot-password</a> <!-- TODO - need? -->
                </div>
                <div class="navbar-nav ml-auto"> <! -- show number of life left and the progress bar -->
                <a class="nav-link" href="#">Life: 6</a>
                <a class="nav-link" href="#">Progress: 0%</a>
                <a class="nav-link" href="../pages/login.php">Logout</a> <!-- TODO - end the session -->
                    
            </div>
        </nav>

        EOT;
        } else {
            echo <<<EOT

        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 200px;"> <!-- TODO MARGIN bottom-->
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="mx-auto text-center" id="navbarNavAltMarkup">
                <div class="navbar-nav"> 
                    <a class="nav-link">Welcome to Kid's Game, sign in to play!</a>
    
                </div>

        </nav>

        EOT;
        }
    }