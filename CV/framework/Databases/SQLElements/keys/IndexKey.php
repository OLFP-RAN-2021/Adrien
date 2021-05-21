<?php

namespace Framework\Databases\SQLElements\Key;

use Framework\Databases\SQLElements\Type;

class IndexKey extends Key
{
    function __construct(
        string $name,
        private Type $type,
        string $index,
    ) {
        parent::__construct($name, $type, $index);
    }
}
