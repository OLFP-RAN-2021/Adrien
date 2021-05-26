<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

class Insert extends AbstractCmd
{

    function __construct(Query $parent)
    {
        $this->request .= ' INSERT INTO ';
    }

    /**
     * 
     */
    function callback(string $tablename = '', array $data = []): self
    {
        if (0 == $this->called) {
            $this->request .= $tablename . ' VALUES ';
        }

        foreach ($data as $row) {
            $this->request .= '(';
            foreach ($row as $key => $value) {
                $nkey = 'key' . md5(microtime());
                $this->data[$nkey] = $value;
                $this->request .= ':' . $nkey . ',';
            }
            $this->request = substr($this->request, 0, -1);
            $this->request .= '),';
        }
        return $this;
    }

    /**
     * 
     */
    function solve(): self
    {
        $this->request = substr($this->request, 0, -1);
        return $this;
    }
}
