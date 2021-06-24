<?php

namespace Framework\Databases\SQLElements\Key;

use Framework\Databases\SQLElements\Type;

class ForeignKey extends Key
{
    function __construct(
        private string $name,
        private Type $type,
        private string $foreign,
        private string $update = 'DEFAULT',
        private string $delete = 'DEFAULT',
        private ?string $index = null,
    ) {
        parent::__construct($name, $type, $index);
    }

    function getForeign()
    {
        return $this->foreign;
    }
}
