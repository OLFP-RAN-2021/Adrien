<?php

namespace Framework\Databases\SQLFluentsQueries;

class AddColumnForeign extends addColumn
{

    function __construct($colname = 'localid', $foreign = 'table.id')
    {
        $this->callback(
            [
                'name' => $colname,
                'type' => 'INT',
                'ai' => true,
                'nn' => true,
                'foreign' => $foreign
            ]
        );
    }
}
