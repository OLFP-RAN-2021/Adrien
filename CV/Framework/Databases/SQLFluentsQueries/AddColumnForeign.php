<?php

namespace Framework\Databases\SQLFluentsQueries;

class AddColumnForeign extends addColumn
{

    function __construct($colname = 'localid', $foreign = 'table.id', ...$const)
    {
        $foreign = [$foreign, ...$const];

        $this->callback(
            [
                'name' => $colname,
                'type' => 'INT',
                'ai' => false,
                'nn' => true,
                'fk' => $foreign
            ]
        );
    }
}
