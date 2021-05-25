<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

class Delete extends AbstractCmd
{
    static $ccall = 0;

    function __construct(Query $parent)
    {
        ++self::$ccall;
        $this->request = ' DELETE FROM ';
    }

    function callback(string $tablename = ''): void
    {
        $this->request .= $tablename . ',';
    }

    function solve(): void
    {
        $this->request = substr($this->request, 0, -1);
    }
}
