<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

class Update extends AbstractCmd
{
    static $ccalled = 0;

    function __construct(Query $parent)
    {
        $this->request = ' UPDATE ';
    }

    /**
     * 
     */
    function callback(string $tablename = '', array $data = []): void
    {
        if (!empty($tablename)) {
            $this->request .= $tablename . ' SET  ';
        }

        foreach ($data as $key => $value) {
            $nkey = 'key' . md5(microtime());
            $this->data[$nkey] = $value;
            $this->request .= $key . ' = :' . $nkey . ', ';
        }
        $this->request = substr($this->request, 0, -1);
    }

    function solve(): void
    {
        $this->request = substr($this->request, 0, -1) . ' ';
    }
}
