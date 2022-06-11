<?php

namespace Vidbu\Fuckingaround\Auth;

use Vidbu\Fuckingaround\database\Model;
use Vidbu\Fuckingaround\View\Json;

class Auth
{
    public static $instance;
    private static $user;
    private static string $token_time = "+30 minutes";
    private static $hashKey;

    public static function authenticate(string $username, string $password): bool
    {
        $sql = sprintf("SELECT * FROM users WHERE password = '%s' AND username = '%s'", $password, $username);
        $data = Model::query($sql)->get();

        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        if (count($data) == 0) {
           return false;
        }

        self::$user = $data;

        $hashKey = hash("sha256", $password . $username);
        $created_at = strtotime(date('Y-m-d'));
        $until = $created_at + strtotime("+15 minutes", strtotime($created_at));

        $sql = sprintf(
            "INSERT INTO auth (userId, auth_key, created_at, until)
            values (%s, '%s', %s, %s)
            ", Auth::id(), $hashKey, $created_at, $until
        );

        Model::query($sql)->exec();
        self::$hashKey = $hashKey;

        return true;
    }

    public static function user()
    {
        return self::$user;
    }

    public static function id()
    {
        return self::$user[0]["id"];
    }

    public static function key()
    {
        return self::$hashKey;
    }
}