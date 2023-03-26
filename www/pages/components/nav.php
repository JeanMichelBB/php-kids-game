<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> 
    <title>Document</title>
</head>
<body>
    <?php
    
    function createNav() {

        echo <<<EOT

        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 150px;"> <!-- TODO MARGIN bottom-->
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="../pages/login.php">Login</a>
                    <a class="nav-link" href="../pages/registration.php">Registration</a>
                    <a class="nav-link href="../pages/history.php">History</a>
                </div>
            </div>
        </nav>

        EOT;
    }
    ?>
</body>
</html>