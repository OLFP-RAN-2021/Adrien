<?php

namespace Framework\Databases\SQLElements\Key;

class IndexKey extends Key
{
    function __construct(
        string $name,
        string $index,
    ) {
        parent::__construct($name, $index);
    }
}
