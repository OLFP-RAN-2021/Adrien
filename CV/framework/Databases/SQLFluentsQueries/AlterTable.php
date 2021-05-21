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

    /**
     * 
     * @param string tablename Table name
     * @return void     
     */
    function callback(string $tablename = '')
    {
        $this->request .= $tablename . ' ';
    }
}
