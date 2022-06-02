<?php

use Vidbu\Fuckingaround\Controller\controllers\IndexController;
use Vidbu\Fuckingaround\initialization;

$router = initialization::getInstance();
$router->setPageNotFound(new IndexController(), "notFound");

$router->get("/", new IndexController(), "index");
$router->get("/test", new IndexController(), "yo");
$router->post("/session", new IndexController(), "check_session");
$router->get("/login", new IndexController(), "login");
$router->post('/login', new IndexController(), "loginUser");