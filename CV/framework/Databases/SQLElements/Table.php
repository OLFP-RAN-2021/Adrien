<?php

namespace Framework\Databases\SQLElements;

class Table
{
    public TableFieldset $fieldset;

    function __construct(
        private string $name,
        TableFieldset $fieldset,
        private ?string $comment = '',
        private ?string $charset = 'utf8mb4-general-ci',
        private ?string $collation = 'utf8mb4-general-ci',
    ) {
        $this->fieldset = $fieldset;
    }

    /**
     * 
     */
    function getName()
    {
        return $this->name;
    }

    function __call($string, $args)
    {
        if (method_exists($this->fieldset, $string))
            return $this->fieldset->$string(...$args);
    }
}
