<?php

namespace Framework\Router;

use Iterator;

/**
 * Class Url
 */
class Url implements Iterator
{

    /**
     * @var int $pos Current position.
     */
    private int $pos = 0;

    /**
     * @var array $stack Stack of elements.
     */
    private array $stack = [];

    /**
     * 
     * 
     * @param string $url
     */
    function __construct(string $url)
    {
        $this->stack = explode('/', $url);
        array_shift($this->stack);
        if ($this->stack[0] == '') {
            $this->stack[0] = '/';
        }
    }

    /**
     * Return current element.
     * 
     * @param void
     * @return mixed
     */
    public function current()
    {
        if (isset($this->stack[$this->pos]))
            return $this->stack[$this->pos];
    }

    /**
     * Return key. 
     */
    public function key()
    {
        return $this->pos;
    }

    public function next()
    {
        ++$this->pos;
    }

    public function rewind()
    {
        $this->pos = 0;
    }

    public function valid()
    {
        return isset($this->stack[$this->pos]);
    }
}
