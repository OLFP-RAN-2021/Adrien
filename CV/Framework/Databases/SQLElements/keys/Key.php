<?php

namespace Framework\Databases\SQLElements\Key;

use Framework\Databases\SQLElements\Type;

class Key
{
    /**
     *  'id' INT(max) PRIMARY KEY NOT NULL AUTO_INCREMENT 
     *  'urlid' INT(max) FOREIGN KEY parent.id REFERENCES parent(parent.id) ON DELETE CASCADE ON UPDATE CASCADE
     *  'url' VARCHAR(max) UNIQUE INDEX (name) 
     *  'title' VARCHAR(max) INDEX (categories)   
     * 
     * @param string    The table column name as key name.
     * @param string    The index name. If empty : column name.
     * @param bool      Is unique value.
     */
    function __construct(
        private string $name,
        public Type $type,
        private string $index = null,
    ) {
        $this->index = $index ?? $name;
    }

    /**
     * 
     */
    function __call($method, $args)
    {
        $call = 'type';
        if (method_exists($this->$call, $method)) {
            return $this->key($args);
        } else if (method_exists($this->$call, '__call')) {
            return $this->$call->$method($args);
        }
    }


    function changeTypeRequest(Type $new = null)
    {
        $this->type = $new;
        return ' CHANGE ' . $this->type . ' ';
    }

    /**
     * 
     * @param void
     * @return string
     */
    function getIndex(): bool
    {
        return $this->index;
    }

    /**
     * Return name.
     * 
     * @param void
     * @return string
     */
    function getName(): string
    {
        return $this->name;
    }

    /**
     * @param void
     * @return bool
     */
    function isPrimary(): bool
    {
        return $this instanceof PrimaryKey;
    }

    /**
     * 
     * @param void
     * @return bool
     */
    function isForeign(): bool
    {
        return $this instanceof ForeignKey;
    }
}
