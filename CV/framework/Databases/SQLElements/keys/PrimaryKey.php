<?php

namespace Framework\Databases\SQLElements\Key;

use Framework\Databases\SQLElements\Type;

class PrimaryKey extends Key
{
    function __construct(
        string $name,
        private Type $type,
        ?string $index = null,
    ) {
        parent::__construct($name, $type, $index, true);
    }

    /**
     * 
     */
    function __toString()
    {
        return  $this->name . ' PRIMARY KEY ';
    }
}
