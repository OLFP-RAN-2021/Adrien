<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

class Enqueue extends AbstractCmd
{
    static $selcall = 0;

    /**
     * 
     * @param Query $parent
     */
    function __construct()
    {
        ++self::$selcall;
        $this->request = '';
    }

    /**
     * 
     * @param Query $query Quryt to melt down.
     */
    function callback(?Query $query = null): self
    {
        $query->runStack();
        $this->request = $query->request;
        $this->data = array_merge($this->data, $query->data);
        return $this;
    }

    function solve(): self
    {
        return $this;
    }
}
