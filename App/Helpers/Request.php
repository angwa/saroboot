<?php

namespace App\Helpers;

class Request
{

    public static function input($data)
    {
        if (isset($_POST[$data])) {
            return $_POST[$data];
        } elseif (isset($_GET[$data])) {
            return $_GET[$data];
        }
        return '';
    }
}
