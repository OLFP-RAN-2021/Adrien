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
    }

    function callback(string $data = "")
    {
        $this->request = 'SELECT ' . $this->esc_var_list($data) . ' FROM ' . $this->parent->tablename . ' ';
    }
}
