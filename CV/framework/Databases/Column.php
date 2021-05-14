<?php

namespace Framework\Databases;

use Framework\Databases\SQLElements\Keys\Keys;

class Column
{
    function __construct(
        private string $colname,
        private Keys $key,
        private ?mixed $value,
        private ?mixed $default,
        private ?string $indexName,
    ) {
    }
}
