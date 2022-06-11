<?php

namespace Vidbu\Fuckingaround\Migrations\Abstract;

use Vidbu\Fuckingaround\database\Database;

abstract class Migration
{
    public Database $con;
    public string $tableName;

    abstract public function run();

    abstract public function down();

    public function __constructor(): void
    {
        $con = Database::connect();
    }
}