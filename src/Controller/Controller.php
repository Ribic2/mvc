<?php

namespace Vidbu\Fuckingaround\Controller;

class Controller
{

    public function getParam(string $param)
    {
        if($_SERVER['REQUEST_METHOD'] == "GET"){
            return $_GET[$param] ?? null;
        }
        return $_POST[$param] ?? null;
    }
}