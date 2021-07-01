<?php

namespace App\views;

use Framework\Render\Render;

class Page
{
    public Render $render;

    function __construct($data)
    {
        $this->render = new Render();
        // var_dump($data['page']);
        $this->render->TITLE->textContent = $data['page']['title'];
        $this->render->BODY->textContent = $data['page']['content'];

        // var_dump($data['menu']);
        $dom = $this->render->DOM;

        $ul = $dom->createElement('ul');
        foreach ($data['menu'] as $url) {
            $li = $dom->createElement('ul');
            $a = $dom->createElement('a');
            $a->setAttribute('href', $url['url']);
            $a->textContent = $url['title'];
            $li->appendChild($a);
            $ul->appendChild($li);
        }

        $this->render->BODY->appendChild($ul);
        echo $this->render;
    }


    function addHeaderTitle(string $title)
    {
    }

    function addHeaderDesc(string $desc)
    {
    }
}
