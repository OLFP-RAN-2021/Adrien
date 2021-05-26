<?php

namespace Framework\Databases\SQLFluentsQueries;

class AddColumnChar extends addColumn
{
    function __construct(string $colname, int $max = 255)
    {
        $this->callback(
            [
                'name' => $colname,
                'type' => 'VARCHAR(' . $max . ')',
            ]
        );
    }
}
