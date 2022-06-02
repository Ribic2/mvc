<?php

namespace Vidbu\Fuckingaround\database;

class Model
{
    public static ?string $table;
    protected static $instance = null;
    protected static string $query = "";

    public static function all(): bool|\PDOStatement
    {
        return Database::connect()->query(sprintf("SELECT * FROM %s;", self::$table));
    }

    public static function select(array $fields): ?Model
    {
        self::$query .= sprintf("SELECT %s FROM %s ",
            implode(",", $fields),
            self::$table
        );

        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function where(string $condition): ?Model
    {
        self::$query .= sprintf("WHERE %s;",
            $condition
        );
        return $this;
    }

    public function get(): bool|array
    {
        return Database::connect()->query(self::$query)->fetchAll();
    }

    public static function query(string $query): ?Model
    {
        self::$query = $query;
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}