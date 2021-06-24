<?php



namespace App\views;

use Framework\Render\Render;

class Link
{
    function __construct($url, $content, $title)
    {
        $this->render = new Render();
    }
}
