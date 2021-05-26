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
            'primary' => true,
            'ai' => true,
            'nn' => true
        ]);
    }
}
