<?php

namespace Framework\Databases\SQLFluentsQueries;

class AddColumnText extends addColumn
{
    function __construct(string $colname)
    {
        $this->callback(
            [
                'name' => $colname,
                'type' => 'TEXT',
            ]
        );
    }
}
