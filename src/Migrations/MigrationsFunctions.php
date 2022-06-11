<?php

namespace Vidbu\Fuckingaround\Migrations;

use DateTime;
use Vidbu\Fuckingaround\database\Model;
use Vidbu\Fuckingaround\Migrations\Abstract\Migration;

class MigrationsFunctions
{
    public bool $defaultIsMigrated = false;
    public array $files = [];
    public array $defaultFiles = [
        "migrationCheckupTable"
    ];

    /**
     * Checks if default tables were already migrated.
     * If not, those are added to files
     * @return void
     */
    public function checkDefaultFiles(): void
    {
        (array)$tables = Model::query("SHOW TABLES;")->get();
        foreach ($this->defaultFiles as $table) {
            if (!in_array($table, $tables)) {
                $dynamicClass = "Vidbu\Fuckingaround\Migrations\Migrations\default";
                $dynamicClass .= "\\" . $table;
                $migration_class = new $dynamicClass;
                $this->files[$table] = new $migration_class;
            }
        }
    }

    public function getFilesToMigrate(): void
    {
        $files = scandir("./Migrations");
        foreach ($files as $file) {
            if (!is_dir("./Migrations/" . $file)) {
                $dynamicClass = "Vidbu\Fuckingaround\Migrations\Migrations";
                $dynamicClass .= "\\" . explode('.php', $file)[0];
                $migration_class = new $dynamicClass;

                $check = Model::query(
                    sprintf("
                SELECT table_name
                FROM information_schema.tables
                WHERE table_schema = 'vaje'
                AND table_name = '%s'
                ", $migration_class->tableName)
                )->get();

                if (count($check) == 0) {
                    $this->files[$migration_class->tableName] = new $migration_class;
                }
            }
        }
    }

    public function createMigrationFile($tableName): void
    {
        $fileName = sprintf("table_%s_create_%s_table", time(), $tableName);
        file_put_contents("./Migrations/" . $fileName . ".php",
            "<?php
            namespace Vidbu\Fuckingaround\Migrations\Migrations;
            use Vidbu\Fuckingaround\Migrations\Abstract\Migration;
            
            class $fileName extends Migration
            {
                public string \$tableName = '$tableName';
                public function run()
                {
                    // TODO: Implement up() method.
                }
            
                public function down()
                {
                    // TODO: Implement down() method.
                }
            }"
        );
    }

    public function migrate(){
        $this->checkDefaultFiles();
        $this->getFilesToMigrate();

        foreach($this->files as $file){
            $file->run();
        }
    }
}