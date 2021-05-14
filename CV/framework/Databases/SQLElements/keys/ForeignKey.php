<?php

namespace Framework\Databases\SQLElements\Keys;

use Framework\Databases\SQLElements\Type;

class ForeignKey extends Keys
{
    function __construct(
        private string $name,
        private ?string $foreign = null,
        private ?string $index = null,
    ) {
        parent::__construct($name, $index, true, true, true);
    }

    function getForeign()
    {
        return Keys::getKey($this->foreign);
    }
}
