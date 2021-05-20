<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

class Insert extends AbstractCmd
{
    static $called = 0;

    function __construct(Query $parent)
    {
        $this->objcalled = 0;
        $this->request .= ' INSERT INTO ';
    }

    /**
     * 
     */
    function callback(string $tablename = '', array $data = [])
    {
        if (0 == $this->objcalled) {
            $this->request .= $tablename . ' VALUES ';
        }
        $this->objcalled++;
        ++self::$called;

        // $data = (!is_array($data[0])) ? [$data] : $data;
        $i = 0;
        foreach ($data as $row) {
            $this->request .= '(';
            foreach ($row as $key => $value) {
                $i++;
                $nkey = self::$called . $this->objcalled . 'insert' . $i . $key;
                $this->data[$nkey] = $value;
                $this->request .= ':' . $nkey . ',';
            }
            $this->request = substr($this->request, 0, -1);
            $this->request .= '),';
        }
    }

    /**
     * 
     */
    function solve()
    {
        $this->request = substr($this->request, 0, -1);
    }
}
