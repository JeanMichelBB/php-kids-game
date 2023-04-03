<?php
class SelectRowFromTable extends ManipulateDB
{
    public function __construct()
    {

    }
    public function selectFromPlayer($username)
    {
        //1-Connect to the DBMS
        if ($this->createConnection() === TRUE) {
                //2-Connect to the DB
                if ($this->connectToDB() === TRUE) {
                    //3-Check that the Table exists 
                    if ($this->executeSql($this->sqlCode()['descPlayer']) === TRUE) {
                        //4-Select data From the Table
                        $stmt = $this->connection->prepare($this->sqlCode()['selectPlayer']);
                        $stmt->bind_param("s", $username);
                        if ($stmt->execute() === TRUE) {
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();                         
                            return $row;
                        }
                        //Cannot Select data From the Table
                        else{
                            echo $this->messages()['link']['tryAgain'];
                            die($this->messages()['error']['selectTab']);
                        }
                    }
                    //Cannot Check that the Table exists
                    else{
                        echo $this->messages()['link']['tryAgain'];
                        die($this->messages()['error']['desTab']);
                    }
                }
                //Cannot Connect to the DB
                else {
                    echo $this->messages()['link']['tryAgain'];
                    die($this->messages()['error']['insertTab']);
                }        
        }
        //Cannot Connect to the DBMS
        else {
            die($this->messages()['error']['dbms']);
        }
    }

    public function selectFromPlayerAuth($username, $password)
    {
        //1-Connect to the DBMS
        if ($this->createConnection() === TRUE) {
                //2-Connect to the DB
                if ($this->connectToDB() === TRUE) {
                    //3-Check that the View exists 
                    if ($this->executeSql($this->sqlCode()['descPlayerAuth']) === TRUE) {
                        //4-Select data From the Table
                        $stmt = $this->connection->prepare($this->sqlCode()['selectPlayerAuth']);
                        $stmt->bind_param("s", $username);

                        if ($stmt->execute() === TRUE) {
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            if (password_verify($password, $row['passCode'])) {
                                return TRUE;
                            } else {
                                return FALSE;
                            }
                        }
                        //Cannot Select data From the Table
                        else{
                            echo $this->messages()['link']['tryAgain'];
                            die($this->messages()['error']['selectTab']);
                        }
                    }
                    //Cannot Check that the Table exists
                    else{
                        echo $this->messages()['link']['tryAgain'];
                        die($this->messages()['error']['desTab']);
                    }
                }
                //Cannot Connect to the DB
                else {
                    echo $this->messages()['link']['tryAgain'];
                    die($this->messages()['error']['insertTab']);
                }        
        }
        //Cannot Connect to the DBMS
        else {
            die($this->messages()['error']['dbms']);
        }
    }

    public function selectFromHistory($userID)
    {
        //1-Connect to the DBMS
        if ($this->createConnection() === TRUE) {
                //2-Connect to the DB
                if ($this->connectToDB() === TRUE) {
                    //3-Check that the Table exists 
                    if ($this->executeSql($this->sqlCode()['descHistory']) === TRUE) {
                        //4-Select data From the Table
                        $stmt = $this->connection->prepare($this->sqlCode()['selectHistory']);
                        $stmt->bind_param("s", $userID);

                        if ($stmt->execute() === TRUE) {
                            $result = $stmt->get_result();
                            while ($row = $result->fetch_assoc()) {
                                $rows[] = $row;
                            }
                            return $rows;
                        }
                        else{
                            echo $this->messages()['link']['tryAgain'];
                            die($this->messages()['error']['selectTab']);
                        }
                    }
                    //Cannot Check that the Table exists
                    else{
                        echo $this->messages()['link']['tryAgain'];
                        die($this->messages()['error']['desTab']);
                    }
                }
                //Cannot Connect to the DB
                else {
                    echo $this->messages()['link']['tryAgain'];
                    die($this->messages()['error']['insertTab']);
                }        
        }
        //Cannot Connect to the DBMS
        else {
            die($this->messages()['error']['dbms']);
        }
    }

}