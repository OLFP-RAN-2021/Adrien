<?php

namespace Framework\Databases\SQLElements\Key;

use Framework\Databases\SQLElements\Type;

class ForeignKey extends Key
{
    function __construct(
        private string $name,
        private Type $type,
        private string $foreign,
        private ?string $index = null,
    ) {
        parent::__construct($name, $type, $index);
    }

    function getForeign()
    {
        return $this->foreign;
    }

    /**
     * 
     */
    function __toString()
    {
        $foreign = explode('.', $this->foreign);
        ' FOREIGN KEY ' . $foreign[1] . ' REFERENCES ' . $foreign[0] . '(' . $foreign[1] . ')';
    }
}
