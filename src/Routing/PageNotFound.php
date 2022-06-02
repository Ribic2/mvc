<?php

namespace Vidbu\Fuckingaround\Routing;

class PageNotFound extends Route
{
    public function __construct($controller, $method)
    {
        parent::__construct("", "", $controller, $method, false);
    }
}