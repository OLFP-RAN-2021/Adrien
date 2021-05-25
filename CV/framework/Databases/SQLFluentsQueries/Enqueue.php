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
    function __construct(Query $parent)
    {
        ++self::$selcall;
        $this->parent = $parent;
        $this->request = '';
    }

    /**
     * 
     * @param Query $query Quryt to melt down.
     */
    function callback(?Query $query = null): void
    {
        $query->runStack();
        $this->request = $query->request;
        $this->data = array_merge($this->data, $query->data);
    }

    function solve(): void
    {
    }
}
