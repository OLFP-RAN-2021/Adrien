<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

class CreateTable extends AbstractCmd
{
    function __constuct(Query $parent)
    {
        $this->parent = $parent;
        $this->request = 'ALTER TABLE ';
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
