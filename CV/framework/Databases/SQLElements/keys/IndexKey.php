<?php

namespace Framework\Databases\SQLElements\Keys;

use Framework\Databases\SQLElements\Type;

class IndexKey extends Keys
{
    function __construct(
        private string $name,
        private string $index,
    ) {
        parent::__construct($this->name, $this->index);
    }
}
