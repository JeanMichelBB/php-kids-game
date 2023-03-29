<?php

function validateNumber($number)
{
    if (is_numeric($number)) {
        return true;
    } else {
        return false;
    }
}

function validateString($string)
{
    if (is_string($string)) {
        return true;
    } else {
        return false;
    }
}


