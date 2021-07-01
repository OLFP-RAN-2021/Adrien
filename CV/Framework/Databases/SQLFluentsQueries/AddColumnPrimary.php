<?php

namespace Framework\Databases\SQLFluentsQueries;

class AddColumnPrimary extends AddColumn
{
    function __construct($colname = 'id')
    {
        // $colname;
        $this->callback([
            'name' => $colname,
            'type' => 'INT',
            'pk' => true,
            'ai' => true,
            'nn' => true
        ]);
    }
}
