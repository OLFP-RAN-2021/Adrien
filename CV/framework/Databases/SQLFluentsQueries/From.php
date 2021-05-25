<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\DBExceptions;
use Framework\Databases\Query;

class From extends AbstractCmd
{
    public string $request = ' FROM ';
    private array $fromstack = [];

    /**
     * 
     */
    function __construct(Query $parent)
    {
        $this->parent = $parent;
        if (($name = $this->parent->tablename) !== null) {
            $this->fromstack[] = $name;
        }
    }

    /**
     * target table
     */
    function callback(string $data = ''): void
    {
        $newname = $this->esc_var($data);
        $this->fromstack[] = $newname;
        $this->parent->tablename = $newname;
    }

    /**
     * Prepare request... 
     * 
     */
    function solve(): void
    {
        $this->request .= implode(',', $this->fromstack);
    }
}
