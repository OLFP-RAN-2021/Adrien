<?php

namespace Framework\Databases\SQLElements;

use Framework\Databases\SQLElements\Key\ForeignKey;
use Framework\Databases\SQLElements\Key\Key;

class Field
{
    function __construct(
        private string $name,
        public Key $key,
        private mixed $value = null,
    ) {
    }

    /**
     * 
     */
    function addColumn()
    {
        $null = ($this->isNullable()) ? '' : ' NOT NULL ';
        $ai = ($this->isIncrementiable()) ? ' AUTO_INCREMENT ' : '';

        if ($this->getType()) {
            return ' ADD ' . $this->name . ' ' . $this->getType() . ' ' . $null . ' ' . $ai;
        }
    }

    /**
     * 
     */
    function renameColumn(string $newname = null)
    {
        return ' RENAME COLUMN ' . $this->name . ' TO ' . $newname;
    }

    // function changeColumn(Type $type)
    // {
    // }

    /**
     * 
     */
    function dropColumn()
    {
        $name = $this->name;
        unset($this);
        return ' DROP ' . $name . ' ';
    }

    /**
     * 
     */
    function addForeign(string $foreign = 'table.id', $onupdate, $ondelete)
    {
        $name = $this->key->getName();
        $type = $this->key->type;
        $index = $this->index;
        $this->key = new ForeignKey($name, $type, $foreign, $onupdate, $ondelete, $index);
        return ' ADD CONSTRAINT ' . $this->name . ' ';
    }

    /**
     * 
     */
    function dropForeign()
    {
        $name = $this->key->getName();
        $type = $this->key->type;
        $index = $this->index;
        $this->key = new Key($name, $type, $index);
        return ' DROP FOREIGN KEY ' . $this->name . ' ';
    }




    /**
     * 
     */
    function __call($method, $args)
    {
        $call = 'key';
        if (method_exists($this->$call, $method)) {
            return $this->key($args);
        } else if (method_exists($this->$call, '__call')) {
            return $this->$call->$method($args);
        }
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
