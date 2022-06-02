<?php

namespace Vidbu\Fuckingaround\Routing;

use Vidbu\Fuckingaround\Controller\Controller;
use Vidbu\Fuckingaround\database\Model;

class Router
{
    public array $paths = [];
    public ?PageNotFound $pathNotFound = null;

    public function get(string $path, Controller $controller, string $method, bool $auth = false): Router
    {
        $this->paths[$path]["GET"] = new Route($path, "GET", $controller, $method, $auth);
        return $this;
    }

    public function post(string $path, Controller $controller, string $method, bool $auth = false): Router
    {
        $this->paths[$path]["POST"] = new Route($path, "POST", $controller, $method, $auth);
        return $this;
    }

    public function getPath()
    {
        $url = $_SERVER['REQUEST_URI'];
        $http_method = $_SERVER['REQUEST_METHOD'];
        $url = explode("?", $url)[0];

        if (isset($this->paths[$url]) && isset($this->paths[$url][$http_method])) {
            return $this->paths[$url][$http_method];
        }
        return $this->pathNotFound;
    }

    public function setPageNotFound(Controller $controller, string $method)
    {
        $this->pathNotFound = new PageNotFound($controller, $method);
    }

    /**
     * @throws \Exception
     */
    public function getContent()
    {
        $path = $this->getPath();
        if ($path == null) {
            throw new \Exception("Path doesn not exist!");
        } else if ($path->auth) {
            header("Location: http://192.168.56.56/login", true, 301);
            exit();
        }
        foreach ($path->params as $param) {
            if (!isset($_GET[$param])) {
                throw new \Exception("Not all required parameters were included!", 400);
            }
        }
        return $this->getPath()->run();
    }

    public function setParams(array $params)
    {
        $this->getPath()->params = $params;
    }
}