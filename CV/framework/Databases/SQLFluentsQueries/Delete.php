<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

class Delete extends AbstractCmd
{
    static $ccall = 0;

    function __construct(Query $parent)
    {
        ++self::$ccall;
    }

    /**
     * 
     */
    function callback(string $tablename = '')
    {
        $this->tablename = $tablename;
    }

    /**
     * 
     */
    function solve()
    {
        $this->request = ' DELETE FROM ' . $this->tablename . ' ';
    }
}
