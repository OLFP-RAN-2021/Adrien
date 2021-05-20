<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

abstract class CreateTable extends AbstractCmd
{

    function __constuct(Query $parent)
    {
        $this->parent = $parent;
        $this->request = 'DROP TABLE ';
    }

    function callback(string $tablename = '')
    {
        $this->request .= $tablename . '';
    }
}
