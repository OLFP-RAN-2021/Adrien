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

    function callback(string $tablename = '', ?array $describ = [], ?string $charset = 'utf8mb4', ?string $collation = 'utf8mb4_general_ci')
    {
        $this->request .= $tablename . '';
        if (isset($describ) && !empty($describ)) {
            $this->request .= '(';
            foreach ($describ as $row) {
                $this->request .= $row;
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
}
