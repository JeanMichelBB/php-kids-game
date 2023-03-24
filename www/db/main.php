<?php
/**
 *demonstration class14.php
 *Insert and Select data from MySQL using MySQLi
 */
//Form Handling
//Go below only after a user pressed the input button name="send" of index.php 
if (isset($_POST['send'])) {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Answer</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <div class="container">
            <h1 class="blueText">Registration List</h1>
            <hr />
            <?php
            //Assign data collected from the form
            $fName = $_POST['fname'];
            $lName = $_POST['lname'];
            $username = $_POST['username'];
            $password = "123456";

            //Load files
            require_once "ManipulateDB.php";
            require_once "CreateDBAndTables.php";
            require_once "InsertRowToTable.php";
            require_once "SelectRowFromTable.php";
            require_once "login_info.php";
            require_once "database_info.php";

            //Create objects 
            $db = new CreateDBAndTables(); // this one needs to be run before everything else
            $insert = new InsertRowToTable();
            $select = new SelectRowFromTable();
            //Instantiate methods
            $db->creatDBTables();
            // $object2->insertNewPlayer($fName, $lName, $username, $password);
            // $object2->insertScore('failure', 6, 1);
            if ($select->selectFromPlayerAuth($username, $password) == TRUE) {
                echo "Welcome back, " . $username . "!";
            } else {
                echo "You are not registered!";
            }
            $insert->insertScore('failure', 6, 1);
            // $history = $select->selectFromHistory(1);
            $rows = $select->selectFromHistory('ANRUANY20230321022028');
            echo "<table>";
            echo "<tr>";
            echo "<th>Player ID</th>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Result</th>";
            echo "<th>Lives Used</th>";
            echo "<th>Score Time</th>";
            echo "</tr>";
            foreach($rows as $row){
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['fName'] . "</td>";
                echo "<td>" . $row['lName'] . "</td>";
                echo "<td>" . $row['result'] . "</td>";
                echo "<td>" . $row['livesUsed'] . "</td>";
                echo "<td>" . $row['scoreTime'] . "</td>";

                echo "</tr>";
            }

            $player = $select->selectFromPlayer("anyruizd");
            echo "<table>";
            echo "<tr>";
            echo "<th>Player ID</th>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Username</th>";
            echo "<th>ID</th>";
            echo "<th>Registration order</th>";
            echo "<th>Registration time</th>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>" . $player['id'] . "</td>";
            echo "<td>" . $player['fName'] . "</td>";
            echo "<td>" . $player['lName'] . "</td>";
            echo "<td>" . $player['username'] . "</td>";
            echo "<td>" . $player['id'] . "</td>";
            echo "<td>" . $player['registrationOrder'] . "</td>";
            echo "<td>" . $player['registrationTime'] . "</td>";

            echo "</tr>";


            ?>

            <div id="back">
                <a href="index.php"><input type="submit" value="Try again!"></a>
            </div>
        </div>
    </body>

    </html>
    <?php
}
?>