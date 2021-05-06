<?php

namespace App\controllers;

use App\models\Page as ModelsPage;

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
        throw new \Framework\Exception("La page a été construite.", ['php' => 'http://php.net'], "Page construite");
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
