<?php

namespace Framework\Databases\SQLElements\Keys;

use Framework\Databases\SQLElements\Type;

class PrimaryKey extends Keys
{
    function __construct(
        private string $name,
        private Type $type,
        private ?string $index = null,
    ) {
        if (($this->type->isIncrementable())) {
            parent::__construct($name, $index, true, true, true);
        } else {
            parent::__construct($name, $index, true, false, true);
        }
    }
}
