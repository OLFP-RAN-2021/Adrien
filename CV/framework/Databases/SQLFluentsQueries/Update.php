<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

class Update extends AbstractCmd
{
    static $ccalled = 0;

    function __construct(Query $parent)
    {
        $this->objcalled = 0;
        ++self::$ccalled;
        $this->request = ' UPDATE ';
    }

    /**
     * 
     */
    function callback(string $tablename = '', array $data = [])
    {
        if (!empty($tablename)) {
            $this->request .= $tablename . ' SET  ';
        }
        ++$this->objcalled;
        $i = 0;

        // foreach ($data as $row) {
        //     $this->request .= '(';
        foreach ($data as $key => $value) {
            $i++;
            $nkey = self::$ccalled . $this->objcalled . 'update' . $i . $key;
            $this->data[$nkey] = $value;
            $this->request .= $key . ' = :' . $nkey . ', ';
        }
        $this->request = substr($this->request, 0, -1);
        //     $this->request .= '),';
        // }
    }

    /**
     * 
     */
    function solve()
    {
        $this->request = substr($this->request, 0, -1) . ' ';
    }
}
