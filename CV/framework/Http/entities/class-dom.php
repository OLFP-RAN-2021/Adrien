<?php 
namespace app\http\entities;

class Dom {

    /**
     * @var string $mime type mime
     */
    public \DOMDocument $dom;
    public $mime = 'text/html';

    /**
     * 
     * @param string $html [optional] code html 
     */
    public function __construct(string $html = null)
    {
        if (isset($html))
        $this->dom = new \DOMDocument();
        $this->dom->loadHTML($html);
    }

    /**
     * @param void
     * @return string $html
     */
    public function __toString()
    {
        return $this->dom->saveHTML();
    }

}