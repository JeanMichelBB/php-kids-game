<?php
class CreateDBAndTables extends ManipulateDB
{
    public function __construct()
    {

    }
    public function creatDBTables()
    {
        //1-Connect to the DBMS
        if ($this->createConnection() === TRUE) {
            //2-Create the DB if it does not exist yet
            $check = $this->executeSql($this->sqlCode()['createDb']);
            $err = $this->messages()['error']['creatDb'];
            $find = 'database exists';
            if (($check === TRUE) || ($check === FALSE && strpos($err, $find) !== FALSE)) {
                //3-Connect to the DB
                if ($this->connectToDB() === TRUE) {
                    //4-Create the Table if it does not exist yet
                    $check = $this->executeSql($this->sqlCode()['createTables'], 'multi');
                    $err = $this->messages()['error']['creatTab'];
                    $find = 'already exists';
                    //Cannot Create the Table even if it does not exist yet
                    if (($check === FALSE && strpos($err, $find) === FALSE)) {
                        echo $this->messages()['link']['tryAgain'];
                        die($this->messages()['error']['creatTab']);
                    }
                }
                //Cannot Connect to the DB
                else {
                    echo $this->messages()['link']['tryAgain'];
                    die($this->messages()['error']['db']);
                }
            }
            //Cannot Create the DB even if it does not exist yet 
            else {
                echo $this->messages()['link']['tryAgain'];
                die($this->messages()['error']['creatDb']);
            }
        }
        //Cannot Connect to the DBMS
        else {
            die($this->messages()['error']['dbms']);
        }
    }
}