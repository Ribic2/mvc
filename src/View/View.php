<?php

namespace Vidbu\Fuckingaround\View;

class View
{
    protected static string $dirPath = "./views/";

    public static function render(string $path, array $data=[])
    {
        extract($data);
        ob_start();
        include self::$dirPath . $path;
        $output = ob_get_clean();
        print $output;
        return $output;
    }
}