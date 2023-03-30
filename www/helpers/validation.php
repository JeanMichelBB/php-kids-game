<?php

function validateNumber($number)
{
    if (is_numeric($number)) {
        return true;
    } else {
        return false;
    }
}

function validString($string)
{
    if (!is_numeric($string)) {
        return true;
    } else {
        return false;
    }
}
