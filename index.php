<?php

use Vidbu\Fuckingaround\initialization;

require __DIR__ . '/vendor/autoload.php';

$instance = new initialization();
$instance->init();
$instance::getInstance()->getContent();

