<?php
            namespace Vidbu\Fuckingaround\Migrations\Migrations;
            use Vidbu\Fuckingaround\database\Model;
            use Vidbu\Fuckingaround\Migrations\Abstract\Migration;
            
            class table_1654368393_create_auth_table extends Migration
            {
                public string $tableName = 'auth';
                public function run()
                {
                    Model::query("
                        CREATE TABLE auth(
                          id int primary key auto_increment,
                          userId int,
                          auth_key varchar(255),
                          created_at varchar(255),
                          until varchar(255),
                          foreign key (userId) REFERENCES users(id)
                        );
                    ")->exec();
                }
            
                public function down()
                {
                    // TODO: Implement down() method.
                }
            }