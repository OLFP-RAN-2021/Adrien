<?php

namespace App\models;

use App\models\entities\PageEntity;

class Page extends PageEntity
{

    /**
     * 
     */
    function __construct()
    {
    }

    /**
     * 
     */
    function get()
    {
    }

    /**
     * 
     */
    function set()
    {
    }

    /**
     * 
     */
    function isset()
    {
    }

    /**
     * 
     */
    function unset()
    {
    }

    /**
     * 
     */
    function __toString()
    {
        $loader = new \Twig\Loader\ArrayLoader([
            'index' => 'Hello {{ name }}!',
        ]);

        $twig = new \Twig\Environment($loader);
        echo $twig->render('index', ['name' => 'Adrien']);
    }
}
