<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

class Nest extends AbstractCmd
{
    static $selcall = 0;
    function __construct(Query $parent, Query $query)
    {
    }

    function callback()
    {
    }

    /**
     * 
     */
    function solve(): array
    {
        return [];
    }
}
