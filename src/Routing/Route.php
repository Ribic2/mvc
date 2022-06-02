<?php
namespace Vidbu\Fuckingaround\Routing;
use Vidbu\Fuckingaround\Controller\Controller;

class Route
{
    public string $path;
    public ?string $http_header;
    public Controller $file_path;
    public string $method;
    public array $params = [];
    public bool $auth;

    public function __construct(string $path, string $http_header, Controller $file_path, string $method, bool $auth)
    {
        $this->http_header = $http_header;
        $this->path = $path;
        $this->method = $method;
        $this->file_path = $file_path;
        $this->auth = $auth;
    }

    public function run()
    {
        $this->file_path->{$this->method}();
    }
}