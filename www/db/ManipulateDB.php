<?php
class ManipulateDB
{
    // //Declare the properties
    protected $connection; 
    protected $sqlExec, $lastErrMsg;

    //Declare the method to save the messages
    protected function messages()
    {
        //Error messages 
        $m['dbms'] = "<p>Connection to MySQL failed!<br/>$this->lastErrMsg</p>";
        $m['db'] = "<p>Connection to the DB failed!<br/>$this->lastErrMsg</p>";
        $m['creatDb'] = "<p>Creation of the DB failed!<br/>$this->lastErrMsg</p>";
        $m['creatTab'] = "<p>Creation of the Table failed!<br/>$this->lastErrMsg</p>";
        $m['insertTab'] = "<p>Data insertion to the Table failed!<br/>$this->lastErrMsg</p>";
        $m['selectTab'] = "<p>Data selection from the Table failed!<br/>$this->lastErrMsg</p>";
        $m['desTab'] = "<p>Table structure description failed!<br/>$this->lastErrMsg</p>";
        //Try again messages
        $b['tryAgain'] = "<a href=\"index.php\"><input type=\"submit\" value=\"Try again!\"></a>";
        //Group messages by category 
        $msg['error'] = $m;
        $msg['link'] = $b;
        return $msg;
    }

    //Declare the method to save the SQL Code to be executed
    protected function sqlCode()
    {
        $dbName = DBNAME;
        $player = PLAYER;
        $auth = AUTHENTICATOR;
        $score = SCORE;

        // views
        $history = HISTORY_VIEW;
        $playerAuth = PLAYER_AUTH_VIEW;
        // Create database
        $sqlCode['createDb'] = "CREATE DATABASE IF NOT EXISTS $dbName;";
        // Create tables and history view
        $sqlCode['createTables'] = "CREATE TABLE IF NOT EXISTS $player( 
            fName VARCHAR(50) NOT NULL, 
            lName VARCHAR(50) NOT NULL, 
            userName VARCHAR(20) NOT NULL UNIQUE,
            registrationTime DATETIME NOT NULL,
            id VARCHAR(200) GENERATED ALWAYS AS (CONCAT(UPPER(LEFT(fName,2)),UPPER(LEFT(lName,2)),UPPER(LEFT(userName,3)),CAST(registrationTime AS SIGNED))),
            registrationOrder INTEGER AUTO_INCREMENT,
            PRIMARY KEY (registrationOrder)
        )CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
        CREATE TABLE IF NOT EXISTS $auth(   
            passCode VARCHAR(255) NOT NULL,
            registrationOrder INTEGER, 
            FOREIGN KEY (registrationOrder) REFERENCES player(registrationOrder)
        )CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
        CREATE TABLE IF NOT EXISTS $score( 
            scoreTime DATETIME NOT NULL, 
            result ENUM('success', 'failure', 'incomplete'),
            livesUsed INTEGER NOT NULL,
            registrationOrder INTEGER, 
            FOREIGN KEY (registrationOrder) REFERENCES player(registrationOrder)
        )CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
        CREATE OR REPLACE VIEW $history AS
            SELECT s.scoreTime, p.id, p.fName, p.lName, s.result, s.livesUsed 
            FROM player p, score s
            WHERE p.registrationOrder = s.registrationOrder;
        CREATE OR REPLACE VIEW $playerAuth AS
            SELECT p.userName AS userName, a.passCode AS passCode
            FROM player p, authenticator a
            WHERE p.registrationOrder = a.registrationOrder;";
        
        // Desc tables & views
        $sqlCode['descPlayer'] = "DESC $player;";
        $sqlCode['descAuth'] = "DESC $auth;";
        $sqlCode['descScore'] = "DESC $score;";
        $sqlCode['descHistory'] = "DESC $history;";
        $sqlCode['descPlayerAuth'] = "DESC $playerAuth;";

        // Select tables
        $sqlCode['selectPlayerAuth'] = "SELECT * FROM $playerAuth WHERE userName = ?;";
        $sqlCode['selectPlayer'] = "SELECT * FROM $player WHERE userName = ?;";
        $sqlCode['selectHistory'] = "SELECT * FROM $history WHERE id = ?;";
        $sqlCode['selectScore'] = "SELECT * FROM $score;";

        // Insert tables 
        $sqlCode['insertPlayer']="INSERT INTO $player (fName, lName, userName, registrationTime) VALUES (?, ?, ?, ?)";
        $sqlCode['insertAuth']="INSERT INTO $auth (passCode, registrationOrder) VALUES (?, ?)";
        $sqlCode['insertScore']="INSERT INTO $score (scoreTime, result , livesUsed, registrationOrder) VALUES (?, ?, ?, ?)";

        // update tables
        $sqlCode['updatePlayerAuth'] = "UPDATE $auth SET passCode = ? WHERE registrationOrder = ?;";


        return $sqlCode;
    }

    //Declare the method to connect to the DBMS
    protected function createConnection()
    {
        //Attempt to connect to MySQL using MySQLi
        mysqli_report(MYSQLI_REPORT_OFF);
        $con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);
        //If connection to the MySQL failed save the system error message 
        if ($con->connect_error) {
            $this->lastErrMsg = mysqli_connect_error();
            return FALSE;
        } else {
            $this->connection = $con;
            return TRUE;
        }
    }

    //Declare the method to connect to the DB
    protected function connectToDB()
    {
        //If connection to the Database failed save the system error message 
        if (mysqli_select_db($this->connection, DBNAME) === FALSE) {
            $this->lastErrMsg = $this->connection->error;
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //Declare the method to execute the SQL Code 
    protected function executeSql($code, $type = '')
    {
        //Execute multi query
        if($type == 'multi')
            $invokeQuery = $this->connection->multi_query($code);
        //Execute single query
        else {
            $invokeQuery = $this->connection->query($code);
        }
        //If data insertion to the table failed save the system error message  
        if ($invokeQuery === FALSE) {
            $this->lastErrMsg = $this->connection->error;
            return FALSE;
        } else
            $this->sqlExec = $invokeQuery;
        return TRUE;
    }

    //Declare the method to disconnect from the DBMS
    public function __destruct()
    {
        //Close automatically the connection from MySQL when it is opened at the end          
        if ($this->connection) {
            $this->connection->close();
        }
    }
}