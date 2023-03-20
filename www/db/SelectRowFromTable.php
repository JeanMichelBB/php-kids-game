<?php
class SelectRowFromTable extends ManipulateDB
{
    public function __construct()
    {

    }
    public function selectFromTable()
    {
        //1-Connect to the DBMS
        if ($this->createConnection() === TRUE) {
                //2-Connect to the DB
                if ($this->connectToDB() === TRUE) {
                    //3-Check that the Table exists 
                    if ($this->executeSql($this->sqlCode()['descTab']) === TRUE) {
                        //4-Select data From the Table
                        if ($this->executeSql($this->sqlCode()['selectTab']) === TRUE) {
                            // $this->displaySelectData();
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
}