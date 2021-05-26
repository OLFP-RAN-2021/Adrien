<?php

namespace Framework\Databases\SQLFluentsQueries;

class AddColumnDouble extends addColumn
{

    function __construct(string $colname, int $max = 32)
    {
        $this->callback(
            [
                'name' => $colname,
                'type' => 'DOUBLE(' . $max . ')',
            ]
        );
    }
}
