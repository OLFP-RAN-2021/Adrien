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
    function gettitle(string $title)
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


        $loader = new \Twig\Loader\FilesystemLoader('App/src/includes/views/twig');
        $twig = new \Twig\Environment($loader, [
            'cache' => 'CV/App/src/includes/views/twig/cache',
        ]);

        echo $twig->render('index.html', ['name' => 'Fabien']);


        $loader = new \Twig\Loader\ArrayLoader([
            'index' => 'Hello {{ name }}!',
        ]);

        $twig = new \Twig\Environment($loader);
        echo $twig->render('index', ['name' => 'Adrien']);
    }
}
