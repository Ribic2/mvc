<?php
namespace Vidbu\Fuckingaround\Migrations\Migrations;
use Vidbu\Fuckingaround\database\Model;
use Vidbu\Fuckingaround\Migrations\Abstract\Migration;
class table_20001201_create_table_users extends Migration
{
    public string $tableName = "users";
    public function run()
    {
        Model::query("
            CREATE TABLE users(
                id int(255) primary key auto_increment,
                name varchar(255),
                surname varchar(255),
                username varchar(255),
                password varchar(255)
            );
        ")->exec();
    }

    public function down()
    {
        // TODO: Implement down() method.
    }
}