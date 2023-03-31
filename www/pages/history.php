<?php
session_start();
if(!isset($_SESSION['username'])) {
    header('Location: login.php');
}
include_once('./components/components.php');
include_once('../db/db.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>history Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .vh-100 {
            height: 100vh;
        }
    </style>
</head>

<body class="vh-100 d-flex flex-column justify-content-between">
    <header>
        <?php
        echo createHeader();
        echo createNav();
        ?>
    </header>
    <article class="container table mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        History
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">

                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">First name</th>
                                    <th scope="col">Last name</th>
                                    <th scope="col">Result</th>
                                    <th scope="col">Number of lives</th>
                                    <th scope="col">Date/time</th>
                                </tr>
                            </thead>
                            <?php
                            $username = $_SESSION['username'];
                            $select = new SelectRowFromTable();
                            $player = $select->selectFromPlayer($username);
                            $rows = $select->selectFromHistory($player['id']);

                            if (empty($rows)) { 
                                echo "<p class='alert alert-danger text-center'>You have no history</p>";
                            } else {
                                foreach ($rows as $row) {
                                    echo "<tbody>";
                                    echo "<tr>";
                                    echo "<th>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['fName'] . "</td>";
                                    echo "<td>" . $row['lName'] . "</td>";
                                    echo "<td>" . $row['result'] . "</td>";
                                    echo "<td>" . $row['livesUsed'] . "</td>";
                                    echo "<td>" . $row['scoreTime'] . "</td>";
                                    echo "</tr>";
                                    echo "</tbody>";
                                }
                            }
                            ?>
                        </table>
                    </div>
                    <div class="mt-3">
                        <p id="result"></p>
                    </div>
                </div>
            </div>
        </div>
    </article>
    </div>
    <?php echo createFooter(); ?>
    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>