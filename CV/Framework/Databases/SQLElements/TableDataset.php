<?php

namespace Framework\Databases\SQLElements;

class TableDataset
{
    private $fieldset;

    function __construct()
    {
    }

    function useFieldset(?TableFieldset $fieldset)
    {
        $this->fieldset = $fieldset;
    }

    function insert()
    {
    }

    function update()
    {
    }

    function delete()
    {
    }
}
