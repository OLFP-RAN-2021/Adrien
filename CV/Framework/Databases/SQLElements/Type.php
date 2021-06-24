<?php

namespace Framework\Databases\SQLElements;

use Framework\Databases\DBExceptions;
use Framework\Databases\SQL;

class Type
{
    /**
     * Type of 
     */
    function __construct(
        private $type = SQL::INT,
        private bool $nullable = true,
        private bool $incremente = false,
    ) {
    }

    /**
     * 
     */
    function __toString()
    {
        return $this->type;
    }


    /**
     * 
     * @param void
     * @return string
     */
    function getType(): string
    {
        return $this->type;
    }

    /**
     * 
     * 
     * @param void
     * @return bool 
     */
    function isNullable()
    {
        return $this->nullable;
    }

    /**
     * 
     */
    function incrementiable(bool $incremente)
    {
        $this->incremente = $incremente;
    }

    /**
     * 
     */
    function isIncrementiable()
    {
        return $this->incremente;
    }
}
