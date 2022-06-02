<?php

use Vidbu\Fuckingaround\database\Database;

abstract class Migration
{
    public Database $con;

    abstract public function run();

    abstract public function down();

    public function __constructor()
    {
        $con = Database::connect();
    }
}