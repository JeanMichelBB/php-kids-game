<?php
session_start();
class Game
{
    public $output = [];
    public $answer;

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
    }

    public function level4()
    {
        $_SESSION['level'] = 4;
        $numbers = $this->createArrayOfNum(); 
        $rightAnswer = $this->createCorrectAnswer($numbers, 'asc');  
    }

    public function level5()
    {
        echo "<p>Level 5 </p>";
    }

    public function level6()
    {
        echo "<p>Level 6 </p>";
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
                $number = rand(0, 100);
            } while (in_array($number, $numbers));
            $numbers[$i] = $number;
        }
        return $numbers;
    }

    function checkAnswer($userInput, $correctAnswer)
    {
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
