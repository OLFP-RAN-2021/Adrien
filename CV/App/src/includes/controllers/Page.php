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
        new ModelsPage(...$params);

        // echo '<pre>' . print_r($table, 1) . '</pre><br>';

        // $callable = function () {
        //     echo "message 1<br>";
        // };

        // $emitter = new Emitter();
        // $emitter->on('event_1', $callable, 2);
        // $emitter->on('event_1', $callable, 2);
        // $emitter->on('event_1', $callable, 2);

        // $emitter->emit('event_1');
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
