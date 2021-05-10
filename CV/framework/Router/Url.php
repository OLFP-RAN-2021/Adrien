<?php

namespace Framework\Router;

use Iterator;

class Url implements Iterator
{

    private int $pos = 0;
    private array $stack = [];

    function __construct(string $url)
    {
        $this->stack = explode('/', $url);
        array_shift($this->stack);
        if ($this->stack[0] == '') {
            $this->stack[0] = '/';
        }
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

    public function rewind()
    {
        $this->pos = 0;
    }

    public function valid()
    {
        return isset($this->stack[$this->pos]);
    }
}
