<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\DBExceptions;
use Framework\Databases\Query;
use Framework\Exception;

class Where extends AbstractCmd
{
    static $called = 0;

    public $data = [];
    public $request = ' WHERE ';
    // private $id = microtime();

    function __construct(Query $parent)
    {
        $this->parent = $parent;
    }

    /**
     * 
     *  'OR'|'AND'|'', 'key', 'operator logic', (mixed) value
     *
     */
    function callback(...$data)
    {
        while (is_array($data[0]))
            $data = $data[0];

        $insert = end($data);
        $insert = (is_bool($insert)) ? $insert : false;

        $nkey = $data[1] . '_' . self::$called;

        if ($insert) {
            $this->request .=  $data[0] . ' ' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . ' ';
        } else {
            $this->request .=  $data[0] . ' ' . $data[1] . ' ' . $data[2] . ' :' . $nkey . ' ';
        }
        $this->data[$nkey] = $data[3];
    }
}
