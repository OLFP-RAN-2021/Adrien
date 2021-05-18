<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

class Insert extends AbstractCmd
{
    static $selcall = 0;

    function __construct(Query $parent, array $data)
    {
        ++self::$selcall;
    }

    function __toString(): string
    {
        return 'INSERT :' . implode(',:', array_keys($this->args)) . ' ';
    }
}
