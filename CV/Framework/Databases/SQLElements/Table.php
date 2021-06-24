<?php

namespace Framework\Databases\SQLElements;

use Framework\Databases\Query;

class Table
{
    function __construct(
        private string $name,
        public TableFieldset $fieldset,
        // public TableDataset $dataset,
        private ?string $comment = '',
        private ?string $charset = 'utf8mb4-general-ci',
        private ?string $collation = 'utf8mb4-general-ci',
    ) {
    }

    /**
     * static constructor
     */
    static function new(...$args)
    {
        return new self(...$args);
    }

    /**
     * 
     */
    function __call($method, $args)
    {
        $call = 'fieldset';
        if (method_exists($this->$call, $method)) {
            return $this->key($args);
        } else if (method_exists($this->$call, '__call')) {
            return $this->$call->$method($args);
        }
    }

    /**
     * 
     */
    function create()
    {
        Query::on()
            ->createTable(
                $this->name,
                $this->getColumnsToCreateTable(),
                $this->comment,
                $this->charset,
                $this->collation,
            )
            ->execute()
            ->fetch();
    }

    /**
     * 
     */
    function truncate()
    {
    }

    /**
     * 
     */
    function drop()
    {
    }


    function select($cond, $data)
    {
        // foreach($data) 
    }

    function insert($data)
    {
        // foreach($data) 
    }

    function update($cond, $data)
    {
        foreach ($data as $key => $value) {
            $field = $this->fieldset[$key];
            if (isset($value) && !empty($value)) {
            }
        }
        // foreach($data) 
    }

    function delete($cond)
    {
        // foreach($data) 
    }
}
