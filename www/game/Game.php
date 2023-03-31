<?php

class Game
{
    public $output = [];
    public $answer = [];

    public $message = '';

    public $inputMaxLength = 1;

    public function __construct()
    {
        if (!isset($_SESSION['level'])) {
            $_SESSION['level'] = 1;
        }
    }
    public function level1()
    {
        $_SESSION['level'] = 1;
        $letters = $this->generateSetOfRandomLetters(6);
        $rightAnswer = $this->createCorrectAnswer($letters, 'asc');
        $this->inputMaxLength = 1;
        $this->output = $letters;
        $this->answer = $rightAnswer;
        $this->message = 'Write the letters in ascending order';
    }

    public function level2()
    {
        $_SESSION['level'] = 2;
        $letters = $this->generateSetOfRandomLetters(6);
        $rightAnswer = $this->createCorrectAnswer($letters, 'desc');
        $this->inputMaxLength = 1;
        $this->output = $letters;
        $this->answer = $rightAnswer;
        $this->message = 'Write the letters in descending order';
    }

    public function level3()
    {
        $_SESSION['level'] = 3;
        $numbers = $this->createArrayOfNum(); 
        $rightAnswer = $this->createCorrectAnswer($numbers, 'asc');  
        $this->inputMaxLength = 2;
        $this->output = $numbers;
        $this->answer = $rightAnswer;
        $this->message = 'Write the numbers in ascending order';
    }

    public function level4()
    {
        $_SESSION['level'] = 4;
        $numbers = $this->createArrayOfNum(); 
        $rightAnswer = $this->createCorrectAnswer($numbers, 'desc'); 
        $this->inputMaxLength = 2;
        $this->output = $numbers;
        $this->answer = $rightAnswer; 
        $this->message = 'Write the numbers in descending order';
    }

    public function level5()
    {
        $_SESSION['level'] = 5;
        // TODO: change this for the real level 5
        $letters = $this->generateSetOfRandomLetters(6);
        $rightAnswer = $this->createCorrectAnswer($letters, 'asc');
        $this->inputMaxLength = 1;
        $this->output = $letters;
        $this->answer = $rightAnswer;
        $this->message = 'Write the letters in ascending order';
    }

    public function level6()
    {
        $_SESSION['level'] = 6;
        // TODO: change this for the real level 6
        $numbers = $this->createArrayOfNum(); 
        $rightAnswer = $this->createCorrectAnswer($numbers, 'asc');  
        $this->inputMaxLength = 2;
        $this->output = $numbers;
        $this->answer = $rightAnswer;
        $this->message = 'Write the numbers in ascending order';
    }

    function generateSetOfRandomLetters($count)
    {
        $letters = range('A', 'Z');
        shuffle($letters);
        return array_slice($letters, 0, $count);
    }

    public function createArrayOfNum()
    {
        $numbers = [];
        for ($i = 0; $i < 6; $i++) {
            do {
                $number = rand(1, 99);
                $number = str_pad($number, 2, '0', STR_PAD_LEFT); // add leading zeros
            } while (in_array($number, $numbers));
            $numbers[$i] = $number;
        }
        return $numbers;
    }

    function validateAnswer($userInput){
        $level = $_SESSION['level'];
        foreach ($userInput as $key => $value) {
            if($level == 1 || $level == 2 || $level == 5) {
                if(validString($userInput[$key])) {
                    return true;
                } else {
                    $_SESSION['input_error'] = 'Your input is not a string!';
                    return false;
                }
            } else {                
                if(!validateNumber($userInput[$key])) {
                    $_SESSION['input_error'] = 'Your input is not a number!';
                    return false;
                } else {
                    return true;
                }
            }  
        }
    }
    
    function checkAnswer($userInput, $correctAnswer){
        $level = $_SESSION['level'];
        if($level == 1 || $level == 2 || $level == 5) {
            $userInput = array_map('strtoupper', $userInput);
        }
        if ($userInput == $correctAnswer) {
            return true;
        } else {
            return false;
        }
    }

    public function createCorrectAnswer($original, $order) : array
    {
        if ($order === 'asc') {
            sort($original);
        } else if ($order === 'desc') {
            rsort($original);
        }
        return $original;
    }

}
