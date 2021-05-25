<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\DBExceptions;
use Framework\Databases\Query;
use Framework\Databases\SQL;

class addColumn extends AbstractCmd
{

    /**
     * 
     */
    function __constuct(Query $parent)
    {
        $this->parent = $parent;
        $this->request = '';
    }

    /**
     * 
     *    
     *    
     */
    function callback(?array $opts = [],): void
    {
        if (!isset($opts['name'])) {
            throw new DBExceptions(["message" => "Add column require a column name."]);
        }
        if (!isset($opts['type'])) {
            throw new DBExceptions(["message" => "Add column require a column a SQL type : VARCHAR, INT, etc.. "]);
        }

        $this->request .= ' ADD ' . $opts['name'] . ' ' . $opts['type'] . '(' . $opts['length'] . ') ';
        if (isset($opts['primary'])) {
            $this->request .= ' PRIMARY KEY ';
        } else if (isset($opts['foreign'])) {
            $f = explode('.', $opts['foreign']);
            $this->request .= ' FOREIGN KEY ' . $f[1] . ' REFERENCES ' . $f[0] . '(' . $f[1] . ') ';
        }
        if (isset($opts['not'])) {
            $this->request .= ' NOT NULL ';
        }
        if (isset($opts['ai'])) {
            $this->request .= ' AUTO_INCREMENT ';
        }
    }

    function solve(): void
    {
    }
}
