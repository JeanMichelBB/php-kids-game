<?php

class Game
{

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

    public function showArrayOfNum($numbers)
    {
        $display = implode(', ', $numbers);
        echo $display;
    }

    public function createCorrectNum($numbers, $order)
    {
        if ($order === 'asc') {
            sort($numbers);
        } else if ($order === 'desc') {
            rsort($numbers);
        }
        return $numbers;
    }

    public function validArrayOfNum($trueNumber, $userInput)
    {
        $userInput = explode(', ', $userInput);
        if ($trueNumber === $userInput) {
            return true;
        } else {
            return false;
        }
    }
}
