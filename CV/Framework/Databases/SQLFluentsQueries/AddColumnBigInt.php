<?php

namespace Framework\Databases\SQLFluentsQueries;

class AddColumnBigInt extends addColumn
{

    function __construct(string $colname, int $max = 64)
    {
        $this->callback(
            [
                'name' => $colname,
                'type' => 'BIGINT(' . $max . ')',
            ]
        );
    }
}
