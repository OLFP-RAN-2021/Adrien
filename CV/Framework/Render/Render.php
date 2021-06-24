<?php

namespace Framework\Render;

use \DOMDocument;

class Render
{
    public DOMDocument $DOM;
    // public \DOMElement $HEAD;
    // public \DOMElement $TITLE;
    // public \DOMElement $BODY;

    /**
     * 
     */
    function __construct()
    {
        $this->DOM = new DOMDocument();
        $this->DOM->loadHTMLFile(__DIR__ . '/html5.html');
        $this->HEAD = $this->DOM->getElementsByTagName('head')[0];
        $this->TITLE = $this->DOM->getElementsByTagName('title')[0];
        $this->BODY = $this->DOM->getElementsByTagName('body')[0];
    }

    function getDom(): DOMDocument
    {
        return $this->DOM;
    }

    /**
     * Add Style Script
     */
    function addStyleScript(string $url = '')
    {
        $link = $this->DOM->createElement('link');
        $link->setAttribute('rel', 'stylesheet');
        $link->setAttribute('type', 'text/css');
        $link->setAttribute('href', $url);
        $this->HEAD->appendChild($link);
        return $this;
    }

    /**
     * Add JS scripts
     */
    function addJsScript(string $url = '', bool $defer = true)
    {
        $link = $this->DOM->createElement('script');
        $link->setAttribute('src', $url);
        if ($defer) {
            $defer = $this->DOM->createAttribute('defer');
            $link->setAttributeNode($defer);
        }
        $this->HEAD->appendChild($link);
        return $this;
    }

    /**
     * Add JS module
     */
    function addJsModule(string $url, string $alias)
    {
        $link = $this->DOM->createElement('script');
        $link->setAttribute('type', 'module');
        $link->value = "import $alias from '$url';";
        $this->HEAD->appendChild($link);
        return $this;
    }


    /**
     * @param 
     */
    static function new(...$args)
    {
        return new self(...$args);
    }

    /**
     * Return HTML constent
     */
    function __toString()
    {
        return $this->DOM->saveHTML();
    }
}
