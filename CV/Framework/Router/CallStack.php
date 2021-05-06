<?php

namespace Framework\Router;

use Iterator;

class CallStack implements Iterator
{

    private int $pos = 0;
    private array $stack = [];

    function __construct(string $url)
    {
    }

    function bind(string $key, $callable)
    {
        $this->stack[$key] = $callable;
    }

    function execute($key)
    {
        $this->stack[$key]->execute();
    }

    function unset(string $key)
    {
        unset($this->stack[$key]);
    }

    public function current()
    {
        return $this->stack[$this->pos];
    }

    public function key()
    {
        return $this->pos;
    }

    public function next()
    {
        ++$this->pos;
    }

    public function prev()
    {
        --$this->pos;
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
