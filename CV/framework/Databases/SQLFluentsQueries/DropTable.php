<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

class CreateTable extends AbstractCmd
{

    function __constuct(Query $parent)
    {
        $this->parent = $parent;
        $this->request = 'DROP TABLE ';
    }

    function callback(string $tablename = '')
    {
        $this->request .= $tablename . ',';
    }

    function solve()
    {
        $this->request = substr($this->request, 0, -1);
    }
}