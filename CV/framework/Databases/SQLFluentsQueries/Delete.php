<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

class Delete extends AbstractCmd
{
    static $selcall = 0;

    function __construct(Query $parent, array|string $data)
    {
        ++self::$selcall;
        if (is_string($data)) $data = explode(',', $data);
        foreach ($data as $key => $value) {
            $value = preg_replace('#[^\w]#i', '', $value);
            $this->args['select_' . self::$selcall . '_' . $value] = $value;
        }
    }

    function callback()
    {
    }

    // function __toString(): string
    // {
    //     return 'DELETE :' . implode(',:', array_keys($this->args)) . ' ';
    // }

    /**
     * 
     */
    function solve(): array
    {
        return [];
    }
}
