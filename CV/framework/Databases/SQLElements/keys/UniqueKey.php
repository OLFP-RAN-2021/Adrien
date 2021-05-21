<?php

namespace Framework\Databases\SQLElements\Key;

use Framework\Databases\SQLElements\Type;

class UniqueKey extends Key
{
    function __construct(
        string $name,
        private Type $type,
        ?string $index = null,

    ) {
        parent::__construct($name, $type, $index, true);
    }
}
