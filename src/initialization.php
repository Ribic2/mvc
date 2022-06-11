<?php

namespace Vidbu\Fuckingaround;

use Vidbu\Fuckingaround\Routing\Router;
use function Composer\Autoload\includeFile;

class initialization
{
    public static ?Router $instance = null;

    public function init(): void
    {
        $this->setInstance();
        include("./src/Routes/Routes.php");
    }


    public static function getInstance(): Router
    {
        return self::$instance;
    }

    protected function setInstance(): Router
    {
        if (!self::$instance) {
            self::$instance = new Router();
        }
        return self::$instance;
    }
}