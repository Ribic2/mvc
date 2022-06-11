<?php

namespace Vidbu\Fuckingaround\Controller\controllers;


use Vidbu\Fuckingaround\Auth\Auth;
use Vidbu\Fuckingaround\database\Model;
use Vidbu\Fuckingaround\Controller\Controller;
use Vidbu\Fuckingaround\View\Json;
use Vidbu\Fuckingaround\View\View;

class IndexController extends Controller
{
    public function index()
    {
        print_r($this->getParam("bro"));
        View::render("index.phtml");
    }

    public function yo()
    {
        Json::render([
            "name" => "vid",
            "surname" => "Bukovec"
        ]);
    }

    public function check_session()
    {
        $data = Model::query("SELECT * FROM sessions WHERE TIMESTAMPDIFF(second, NOW(), until) > 0;");

        return Json::render([
            "status" => $data->get()
        ]);
    }

    public function notFound()
    {
        echo "404 homie!";
    }

    public function login()
    {
        View::render("login.phtml", ["hrana" => $this->getParam("hello")]);
    }

    public function loginUser()
    {
        (string)$username = $this->getParam('username');
        (string)$password = $this->getParam('password');

        if(!Auth::authenticate($username, $password)){
            return Json::render([
                "status" => "User not found"
            ]);
        }

        return Json::render([
           "key" => Auth::key()
        ]);
    }
}