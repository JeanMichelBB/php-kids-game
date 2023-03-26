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
function createFooter() {
// footer {
//     margin-top: 20px;
// }





// different color for the footer. Developed by Any Ruiz, Jean-Michel Bérubé, Hallan
    echo <<<EOT
    <div class="mt-5"></div>
    <footer class="bg-dark text-white text-center text-lg-start" style="margin-top: 250px;"> <!-- TODO MARGIN TOP-->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            Developed by Any Ruiz, Jean-Michel Bérubé, Hallan
        </div>
    
EOT;
}
?>
</body>
</html>