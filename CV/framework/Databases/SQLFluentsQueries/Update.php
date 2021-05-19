<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

class Update extends AbstractCmd
{
    static $selcall = 0;

    function __construct(Query $parent, array $data)
    {
        ++self::$selcall;
    }


    function callback()
    {
    }

    function __toString(): string
    {
        return 'UPDATE :' . implode(',:', array_keys($this->args)) . ' ';
    }

    /**
     * 
     */
    function solve(): array
    {
        return [];
    }
}
