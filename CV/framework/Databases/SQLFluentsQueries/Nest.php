<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;
use Framework\Databases\SQL;

class Nest extends AbstractCmd
{
    static $selcall = 0;

    function __construct(Query $parent)
    {
        ++self::$selcall;
        $this->parent = $parent;
    }

    /**
     * 
     */
    function callback(string $key = '', ?Query $query = null): void
    {
        $query->runStack();
        $this->parent->where($key, SQL::EQUAL, '(' . $query->request . ')', true);
        $this->data = $query->data;
    }

    /**
     * 
     */
    function solve(): void
    {
        // var_dump($this->data);
    }
}
