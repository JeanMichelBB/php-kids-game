<?php
class InsertRowToTable extends ManipulateDB
{

    public function insertNewPlayer($firstName, $lastName, $username, $password)
    {
        //1-Connect to the DBMS
        if ($this->createConnection() === TRUE) {
                //2-Connect to the DB
                if ($this->connectToDB() === TRUE) {
                    //3-Check that the Table exists 
                    if ($this->executeSql($this->sqlCode()['descPlayer']) === TRUE) {
                        //4-Insert data to the Table
                        $stmt = $this->connection->prepare($this->sqlCode()['insertPlayer']);
                        $stmt->bind_param("ssss", $firstName, $lastName, $username, date("Y-m-d"));
                        if($stmt->execute() === FALSE) {
                            echo $this->messages()['link']['tryAgain'];
                            die($this->messages()['error']['insertTab']);
                        } else {
                            $password = password_hash($password, PASSWORD_DEFAULT);
                            $registrationOrder = $this->connection->insert_id;
                            $stmt = $this->connection->prepare($this->sqlCode()['insertAuth']);
                            $stmt->bind_param("ss", $password, $registrationOrder);
                            if($stmt->execute() === FALSE) {
                                echo $this->messages()['link']['tryAgain'];
                                die($this->messages()['error']['insertTab']);
                            } else {
                                return TRUE;
                            }
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

    public function insertScore($userResult, $lives, $username) {
        //1-Connect to the DBMS
        if ($this->createConnection() === TRUE) {
                //2-Connect to the DB
                if ($this->connectToDB() === TRUE) {
                    //3-Check that the Table exists 
                    if ($this->executeSql($this->sqlCode()['descScore']) === TRUE) {
                        //4-Select player
                        $stmt = $this->connection->prepare($this->sqlCode()['selectPlayer']);
                        $stmt->bind_param("s", $username);
                        if($stmt->execute() === FALSE) {
                            echo $this->messages()['link']['tryAgain'];
                            die($this->messages()['error']['insertTab']);
                        } else {
                            $result = $stmt->get_result();
                            $player = $result->fetch_assoc();
                            $registrationOrder = $player['registrationOrder'];
                            //5-Insert data to the Table
                            $stmt = $this->connection->prepare($this->sqlCode()['insertScore']);
                            $stmt->bind_param("ssss", date("Y-m-d H:i:s"), $userResult, $lives, $registrationOrder);

                            if($stmt->execute() === FALSE) {
                                echo $this->messages()['link']['tryAgain'];
                                die($this->messages()['error']['insertTab']);
                            } else {
                                return TRUE;
                            }
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