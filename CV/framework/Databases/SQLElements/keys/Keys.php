<?php

namespace Framework\Databases\SQLElements\Keys;

use Framework\Databases\SQLExceptions;

class Keys
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
     * @param bool      Is auto_incremented
     * @param bool      Is primary
     * @param bool      Is foreign
     */
    function __construct(
        private string $name,
        private ?string $indexName = null,
        private ?bool $is_unique = false,
        private ?bool $auto_increment = false,
        private ?bool $is_primary = false,
        private ?bool $is_foreign = false,
    ) {
        $this->indexName = $indexName ?? $name;

        if (!self::issetKey($name)) {
            self::$keysList[$name] = $this;
        } else {
            // throw new SQLExceptions(["mmsg"=>""]);
        }
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
     */
    function getIndex(): bool
    {
        return $this->indexName;
    }

    /**
     * 
     */
    function getName(): bool
    {
        return $this->name;
    }

    /**
     * 
     */
    function isUnique(): bool
    {
        return $this->is_unique;
    }

    /**
     * 
     */
    function isPrimary(): bool
    {
        return $this->is_primary;
    }

    /**
     * 
     */
    function isForeign(): bool
    {
        return $this->is_foreign;
    }

    /**
     * 
     */
    function isAutoIncremented(): bool
    {
        return $this->auto_increment;
    }
}
