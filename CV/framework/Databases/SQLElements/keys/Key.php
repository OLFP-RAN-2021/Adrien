<?php

namespace Framework\Databases\SQLElements\Key;

use Framework\Databases\DBExceptions;
use Framework\Databases\SQLElements\Type;

class Key
{
    /**
     * 
     */
    static array $keysList = [];

    /**
     * 
     * @param string    The table column name as key name.
     * @param string    The index name. If empty : column name.
     * @param bool      Is unique value.
     */
    function __construct(
        private string $name,
        private Type $type,
        private ?string $index = null,
        private ?bool $is_unique = false,
    ) {
        $this->index = $index ?? $name;
        if (!self::issetKey($name)) {
            self::$keysList[$name] = $this;
        } else {
            throw new DBExceptions(["message" => "This table Key elready exist."]);
        }
    }

    /**
     * 
     */
    function toString()
    {
        return $this->name;
    }


    /**
     * Isset key.
     * 
     * @param string
     * @return bool
     */
    static function issetKey(string $name): bool
    {
        return array_key_exists($name, self::$keysList);
    }

    /**
     * Unset key.
     * 
     * @param string
     * @return null|self
     */
    static function getKey(string $name): null|self
    {
        if (self::issetKey($name)) {
            return self::$keysList[$name];
        }
        return null;
    }

    /**
     * Unset key
     * 
     * @param string
     * @return void
     */
    static function unsetKey(string $name): void
    {
        unset(self::$keysList[$name]);
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
     * 
     * 
     * @param void
     * @return bool
     */
    function isUnique(): bool
    {
        return $this->is_unique;
    }

    /**
     * 
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
