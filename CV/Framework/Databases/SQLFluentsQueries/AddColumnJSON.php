<?php

namespace Framework\Databases\SQLFluentsQueries;

class AddColumnJSON extends addColumn
{

    function __construct(string $colname)
    {
        $this->callback(
            [
                'name' => $colname,
                'type' => 'JSON',
            ]
        );
    }
}
