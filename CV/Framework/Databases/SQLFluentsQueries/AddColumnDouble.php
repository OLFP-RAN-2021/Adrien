<?php

namespace Framework\Databases\SQLFluentsQueries;

class AddColumnDouble extends addColumn
{
    function __construct(string $colname)
    {
        $this->callback(
            [
                'name' => $colname,
                'type' => 'DOUBLE',
            ]
        );
    }
}
