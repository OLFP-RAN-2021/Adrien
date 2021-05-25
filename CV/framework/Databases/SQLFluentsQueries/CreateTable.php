<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

class CreateTable extends AbstractCmd
{
    function __constuct(Query $parent)
    {
        $this->parent = $parent;
        $this->request = 'CREATE TABLE IF NOT EXISTS ';
    }

    /**
     * 
     * @param string $tablemane Table name
     * @param null|array $describ Array to list table fields
     * @param null|string $charset Charset
     * @param null|string $collation Collation
     * @return void
     * 
     * @see AddColumn.php
     */
    function callback(
        string $tablename = '',
        ?array $describ = [],
        ?string $charset = 'utf8mb4',
        ?string $collation = 'utf8mb4_general_ci'
    ): void {
        $this->request .= $tablename . '';
        if (isset($describ) && !empty($describ)) {
            $this->request .= '(';
            foreach ($describ as $row) {
                if (is_string($row)) {
                    $this->request .= $row;
                } else if (is_array($row)) {
                    $row = new addColumn($row);
                    $row = $row->request;
                }
            }
            $this->request .= ')';
        }
        if ($charset) {
            $this->request .= ' CHARACTER SET ' . $charset;
        }
        if ($collation) {
            $this->request .= ' COLLATE ' . $collation;
        }
    }

    function solve(): void
    {
    }
}
