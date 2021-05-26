<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

class Delete extends AbstractCmd
{
    static $ccall = 0;

    function __construct()
    {
        ++self::$ccall;
        $this->request = ' DELETE FROM ';
    }

    function callback(string $tablename = ''): self
    {
        $this->request .= $tablename . ',';
        return $this;
    }

    function solve(): self
    {
        $this->request = substr($this->request, 0, -1);
        return $this;
    }
}
