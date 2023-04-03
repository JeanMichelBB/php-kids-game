<?php
class UpdateTable extends ManipulateDB
{
    public function updatePlayerAuth($registrationOrder, $password)
    {
        //1-Connect to the DBMS
        if ($this->createConnection() === TRUE) {
            //2-Connect to the DB
            if ($this->connectToDB() === TRUE) {
                //3-Check that the Table exists 
                if ($this->executeSql($this->sqlCode()['descAuth']) === TRUE) {
                    //4-update data to the Table with the new password
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $this->connection->prepare($this->sqlCode()['updatePlayerAuth']);
                    $stmt->bind_param("ss", $password, $registrationOrder);
                    if ($stmt->execute() === FALSE) {
                        echo $this->messages()['link']['tryAgain'];
                        die($this->messages()['error']['insertTab']);
                    } else {
                        return TRUE;
                    }
                }
                //Cannot Check that the Table exists
                else {
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
