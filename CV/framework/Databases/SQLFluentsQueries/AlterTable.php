<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

class CreateTable extends AbstractCmd
{
    function __constuct()
    {
        $this->request = 'ALTER TABLE ';
    }

    function callback(string $tablename = ''): self
    {
        $this->request .= $tablename . ',';
        return $this;
    }

    function solve(): self
    {
        $this->request = substr($this->request, 0, -1);
        return $this;
    }
}
