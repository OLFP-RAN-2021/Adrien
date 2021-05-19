<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\DBExceptions;
use Framework\Databases\Query;
use Framework\Exception;

class From extends AbstractCmd
{
    static $called = 0;

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
     *  'OR'|'AND'|'', 'key', 'operator logic', (mixed) value
     */
    function callback(...$data)
    {
        if (is_string($data)) {
            $data = $this->esc_var($data);
            $this->fromstack[] = $data;
        }
    }

    /**
     * Prepare request... 
     * 
     */
    function solve()
    {
        $this->request .= implode(',', $this->fromstack);
    }
}
