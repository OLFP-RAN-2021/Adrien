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
        ?string $charset = 'utf8mb4',
        ?string $collation = 'utf8mb4_general_ci',
    ): self {

        if ($temporary)
            $this->request .= ' TEMPORARY ';

        $this->request .= ' TABLE ';

        if ($ifnotexist)
            $this->request .= ' IF NOT EXISTS ';

        $this->request .= $tablename . ' ';
        if (!isset($describ) or empty($describ)) {
            $describ = $this->getDefaultCol();
        }

        $this->request .= '(';
        foreach ($describ as $row) {
            if (is_object($row)) {
                $this->request .= ' ' . substr($row->request, 4) . ',';
            } else {
                if (is_string($row)) {
                    $this->request .= $row . ',';
                }
            }
        }
        $this->request = substr($this->request, 0, -1);
        $this->request .= ')';

        if ($charset)
            $this->request .= ' CHARACTER SET ' . $charset;

        if ($collation)
            $this->request .= ' COLLATE ' . $collation;

        return $this;
    }

    /**
     * Get default column : id column.
     */
    private function getDefaultCol()
    {
        return ['id INT(16) NOT NULL PRIMARY KEY AUTO_INCREMENT'];
    }

    /**
     *
     */
    public function solve(): self
    {
        return $this;
    }
}
