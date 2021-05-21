<?php

namespace Framework\Databases\SQLElements;

use Framework\Databases\SQLElements\Key\Key;

class Field
{
    function __construct(
        private string $name,
        private Key $key,
        private mixed $value = null,
    ) {
    }

    function getKey()
    {
        return $this->key;
    }

    function getType()
    {
        return $this->type;
    }

    function getName()
    {
        return $this->name;
    }

    function setValue(mixed $value)
    {
        $this->vaulue = $value;
    }

    function getValue()
    {
        return $this->vaulue;
    }
}
