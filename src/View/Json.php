<?php
namespace Vidbu\Fuckingaround\View;

class Json
{
    public static function render(array $data){
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
}