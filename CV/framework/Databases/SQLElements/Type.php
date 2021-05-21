<?php

namespace Framework\Databases\SQLElements;

use Framework\Databases\DBExceptions;
use Framework\Databases\SQLExceptions;
use Framework\Exception;

class Type
{
    const INT = ['INT', -2147483648, 2147483647];
    const INT_UNSIGNED = ['INT', 0, 4294967295];
    const FLOAT = ['FLOAT', 0, 24];
    const DOUBLE = ['DOUBLE', 0, 65];
    const BIN = ['BINARY', 1, 1];
    const BINARY = ['BINARY', 1, 1];
    const BOOL = ['BOOL', 1, 1];

    const CHAR = ['CHAR', 0, 255];
    const VARCHAR = ['VARCHAR', 0, 65535];
    const TEXT = ['TEXT', 0, 65535];
    const LONGTEXT = ['TEXT', 0, 4294967295];
    const BLOB = ['BLOB', 0, 65535];
    const LONGBLOB = ['LONGBLOB', 0, 4294967295];

    const DATE = ['DATE', ''];
    const DATETIME = ['DATETIME', ''];
    const TIMESTAMP = ['TIMESTAMP', ''];
    const TIME = ['TIME', ''];
    const YEAR = ['YEAR', ''];

    function __construct(
        private $type = self::INT,
        private ?int $min = null,
        private ?int $max = null,
        private ?bool $nullable = true,
    ) {
        if (null != $this->min && $this->min < $this->type[1]) {
            $this->min = $this->type[1];
            throw new DBExceptions([
                "message" => "Min must be heigther or equal to DB support(" . $this->type[1] . ").",
                "code" => 400
            ]);
        }
        if (null != $this->max && $this->max > $this->type[2]) {
            $this->max = $this->type[2];
            throw new DBExceptions([
                "message" => "Max must be lower or equal to DB support(" . $this->type[2] . ").",
                "code" => 400
            ]);
        }
    }

    /**
     * 
     */
    function getValue()
    {
        return $this->value;
    }

    /**
     * 
     */
    function setValue(mixed $value = null)
    {
        if (!$this->isNullable() && null == $value) {
            throw new DBExceptions([
                "message" => "This field is not nullable.",
                "code" => 400
            ]);
        }
        $this->value = $value;
    }

    /**
     * 
     */
    function isNullable()
    {
        return $this->nullable;
    }

    /**
     * 
     * @param void
     * @return string
     */
    function getType(): string
    {
        return $this->type[0];
    }

    /**
     * 
     * @param void
     * @return float|int
     */
    function getMin(): float|int
    {
        return $this->max ?? $this->type[1];
    }

    /**
     * 
     * @param void
     * @return float|int
     */
    function getMax(): float|int
    {
        return $this->min ??  $this->type[2];
    }

    /**
     * Return true if is incrementable : is number.
     * 
     * @param void
     * @return bool
     */
    function isIncrementable(): bool
    {
        return in_array($this->type[0], ['INT', 'FLOAT', 'DOUBLE']);
    }
}
