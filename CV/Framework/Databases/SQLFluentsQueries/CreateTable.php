<?php

namespace Framework\Databases\SQLFluentsQueries;


class CreateTable extends AbstractCmd
{
    function __construct()
    {
        $this->request = 'CREATE ';
        $this->callonce = true;
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
        ?bool $temporary = false,
        ?bool $ifnotexist = false,
        ?array $describ = [],
        ?string $charset = null,
        ?string $collation = null,
    ): self {
        $this->agregate('TEMPORARY', $temporary);
        $this->agregate('TABLE', '');
        $this->agregate('IF NOT EXISTS', $ifnotexist);
        $this->agregate($tablename, '');
        $this->agregateCols($describ);
        $this->agregate('CHARACTER SET', $charset ?? 'utf8mb4');
        $this->agregate('COLLATE', $collation ?? 'utf8mb4_general_ci');
        return $this;
    }

    /**
     * 
     */
    function agregate($cond = '', $value = '')
    {
        if (is_bool($value)) {
            if (true == $value)
                $this->request .= ' ' . $cond . ' ';
        } else {
            $this->request .= ' ' . $cond . ' ' . $value;
        }
    }

    /**
     * 
     */
    function agregateCols(array $describ = ['id INT(16) NOT NULL PRIMARY KEY AUTO_INCREMENT'])
    {
        $this->request .= '(';
        $append = '';
        foreach ($describ as $row) {
            if (is_object($row)) {
                $this->request .= ' ' . substr($row->request, 4) . ',';
                if (isset($row->append))
                    $append .= $row->append;
            } else {
                if (is_string($row)) {
                    $this->request .= $row . ',';
                }
            }
        }
        if ($append) {
            $this->request .= $append;
        }
        $this->request = substr($this->request, 0, -1);
        $this->request .= ')';
    }

    /**
     *
     */
    public function solve(): self
    {

        return $this;
    }
}
