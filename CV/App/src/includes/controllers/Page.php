<?php

namespace App\controllers;

use App\models\Page as ModelsPage;
use Framework\EventListener\Emitter;
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

        echo "<br><br>page built<br><br>";

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
