<?php

namespace Framework\Databases\SQLFluentsQueries;

class AddColumnInt  extends addColumn
{
    function __construct(string $colname, int $max = 16)
    {
        $this->callback(
            [
                'name' => $colname,
                'type' => 'INT(' . $max . ')',
            ]
        );
    }
}
