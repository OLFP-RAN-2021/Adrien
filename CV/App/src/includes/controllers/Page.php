<?php
namespace App\controllers;

use stdClass;
use Twig\TwigFunction;

// use app\http\Request;
// use app\http\Response;

class Page
{
    function __construct()
    {
        var_dump('object Page built');
        $loader = new \Twig\Loader\ArrayLoader([
            'index' => 'Hello {{ name }}!',
        ]);

        $twig = new \Twig\Environment($loader);
        echo $twig->render('index', ['name' => 'Adrien']);
        
    }

}
