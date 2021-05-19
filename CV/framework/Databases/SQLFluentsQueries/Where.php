<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\DBExceptions;
use Framework\Databases\Query;
use Framework\Exception;

class Where extends AbstractCmd
{
    static $called = 0;

    public string $request = ' WHERE ';
    private array $wherestack = [];

    function __construct(Query $parent)
    {
        $this->parent = $parent;
        $this->objcalled = 0;
    }

    /**
     *  
     */
    function callback(?string $op = 'AND', ?string $key = '', ?string $logic = '', $value = null, bool $insert = false)
    {

        $op = (0 == $this->objcalled) ?  '' : $op;

        $nkey = $key .  self::$called  . $this->objcalled;
        ++$this->objcalled;

        if ($insert) {
            $this->wherestack[] =  ' ' . $op . ' ' . $key . ' ' . $logic . ' ' . $value;
        } else {
            $this->wherestack[] =  ' ' . $op . ' ' . $key . ' ' . $logic . ' :' . $nkey;
            $this->data[$nkey] = $value;
        }
    }

    /**
     * Prepare request... 
     * 
     */
    function solve()
    {
        foreach ($this->wherestack as $stack) {
            $this->request .= $stack;
        }
    }
}
