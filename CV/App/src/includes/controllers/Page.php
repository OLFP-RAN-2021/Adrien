<?php

namespace App\controllers;

use App\models\Page as ModelsPage;
use Framework\Exception;

// use app\http\Request;
// use app\http\Response;

class Page
{
    /**
     * 
     */
    function __construct(...$params)
    {
        // var_dump(array('built'));
        $throwable =  new \Framework\Exception([
            "message" => "Page construite",
            "refs" => ['php' => 'http://php.net'],
            "code" => 100,
            // "description" => "La page a été construite.",
        ]);

        throw new \Framework\Exception([
            "message" => "Penser à fignoler le debbuger.",
            "throwable" => $throwable,
            // "refs" => ['php' => 'http://php.net'],
            "code" => 300,
            "description" => "La page a été construite.",
        ]);

        // $PAGE = new ModelsPage();
        // var_dump('Controllers object Page built');
    }

    /**
     * 
     * 
     */
    function list()
    {
    }

    /**
     * 
     */
    function read(...$params)
    {
        var_dump(array('read'));
        var_dump($params);
    }

    /**
     * 
     */
    function print(...$params)
    {
    }
}
