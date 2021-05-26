<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\DBExceptions;
use Framework\Databases\Query;
use Framework\Exception;

class Where extends AbstractCmd
{

    public string $request = ' WHERE ';
    private array $wherestack = [];

    function __construct(Query $parent)
    {
        $this->parent = $parent;
        $this->objcalled = 0;
    }

    function callback(
        ?string $op = 'AND',
        ?string $key = '',
        ?string $logic = '',
        $value = null,
        bool $insert = false
    ): self {

        $op = (0 == $this->objcalled) ?  '' : $op;

        $nkey = 'key' . md5(microtime());

        if ($insert) {
            $this->wherestack[] =  ' ' . $op . ' ' . $key . ' ' . $logic . ' ' . $value;
        } else {
            $this->wherestack[] =  ' ' . $op . ' ' . $key . ' ' . $logic . ' :' . $nkey;
            $this->data[$nkey] = $value;
        }
        return $this;
    }

    function solve(): self
    {
        foreach ($this->wherestack as $stack) {
            $this->request .= $stack;
        }
        return $this;
    }
}
