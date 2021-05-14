<?php

namespace Framework\Databases\SQLElements\Key;

class PrimaryKey extends Key
{
    function __construct(
        string $name,
        ?string $index = null,
    ) {
        parent::__construct($name, $index, true);
    }
}
