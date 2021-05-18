<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

class Nest extends AbstractCmd
{
    static $selcall = 0;

    function __construct(Query $parent)
    {
        ++self::$selcall;
        $this->parent = $parent;
    }

    function callback(string $key, ?Query $query)
    {
        $query->runStack();
        if (null == $this->parent->Where) {
            $this->request = ' WHERE ' . $key . ' = (' . $query->request . ')';
        } else {
            $this->request = ' AND ' . $key . ' = (' . $query->request . ')';
        }
        $this->data = $query->data;
    }
}
