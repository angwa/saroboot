<?php

namespace App\Helpers;

class Response
{

    public static  function message($data = array())
    {
        echo json_encode($data);
    }
}
