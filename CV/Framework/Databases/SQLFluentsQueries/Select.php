<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

class Select extends AbstractCmd
{
    static $selcall = 0;

    function __construct(Query $parent)
    {
        ++self::$selcall;
        $this->parent = $parent;
        $this->request = 'SELECT ';
    }

    function callback(string $data = ""): self
    {
        $this->request .= $this->esc_var_list($data);
        return $this;
    }

    function solve(): self
    {
        return $this;
    }
}
