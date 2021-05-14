<?php

namespace Framework\Databases\SQLElements;

class Table
{

    function __construct(
        private string $name,
        private TableFieldset $fieldset,
        private TableDataset $dataset,
        private ?string $comment = '',
        private ?string $charset = 'utf8mb4-general-ci',
        private ?string $collation = 'utf8mb4-general-ci',
    ) {
        $this->dataSet->useFieldset($this->fieldset);
    }

    function getName()
    {
        return $this->name;
    }
}
