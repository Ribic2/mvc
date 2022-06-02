<?php

namespace Vidbu\Fuckingaround\Controller\controllers;


use Vidbu\Fuckingaround\database\Model;
use Vidbu\Fuckingaround\database\Models\Agent;
use Vidbu\Fuckingaround\Controller\Controller;
use Vidbu\Fuckingaround\View\Json;
use Vidbu\Fuckingaround\View\View;

class IndexController extends Controller
{
    public function index()
    {
        View::render("index.phtml", ["agents" =>
            Model::query("SELECT * FROM AGENTS WHERE AGENT_CODE = 'A002'")->get()
        ]);
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
        Model::query("SELECT * FROM AGENTS")->get();
        View::render("login.phtml", ["hrana" =>  $this->getParam("hello")]);
    }

    public function loginUser()
    {
        (string)$username = $this->getParam('username');
        (string)$password = $this->getParam('password');



        return Json::render([
            "username" => $username,
            "password" => $password
        ]);
    }
}