<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<?php
function createHeader() {
    echo <<<EOT
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex flex-row justify-content-space-evenly align-items-center">
                        <div class="p-2">
                            <img src="../../img/LogoKidGame.png" alt="logo" width="100" height="100">
                        </div>

                        <div class="p-2">
                            <h1 class="text-center">Kid's Game</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
EOT;
}
?>
</body>
</html>