<?php

namespace Vidbu\Fuckingaround\Controller;

class Controller
{

    public function getParam(string $param)
    {
       return ${"_".$_SERVER['REQUEST_METHOD']}[$param];
    }
}