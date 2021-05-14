<?php

namespace Framework\Databases\SQLElements\Key;

use Framework\Databases\SQLElements\Type;

class ForeignKey extends Key
{
    function __construct(
        private string $name,
        private string $foreign = null,
        private ?string $index = null,
    ) {
        parent::__construct($name, $index);
    }

    function getForeign()
    {
        return $this->foreign;
    }
}
