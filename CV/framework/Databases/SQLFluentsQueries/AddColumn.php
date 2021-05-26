<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\DBExceptions;

class addColumn extends AbstractCmd
{

    function __constuct()
    {
    }

    /**
     * Get a new Instance of addColumn or child element.
     *
     * @param ...$args
     * @return self
     */
    static function new(...$args): self
    {
        return new self(...$args);
    }

    /**
     *
     *  
     *
     */
    function callback(?array $opts = []): self
    {
        if (!isset($opts['name'])) {
            throw new DBExceptions(["message" => "Add column require a column name."]);
        }
        if (!isset($opts['type'])) {
            throw new DBExceptions(["message" => "Add column require a column a SQL type : VARCHAR, INT, etc.. "]);
        }

        $length = (isset($opts['length'])) ?  '(' . $opts['length'] . ') ' : '';
        $this->request = ' ADD ' . $opts['name'] . ' ' . $opts['type'] . $length;
        if (isset($opts['primary'])) {
            $this->request .= ' PRIMARY KEY ';
        } else if (isset($opts['foreign'])) {
            $f = explode('.', $opts['foreign']);
            $this->request .= ' FOREIGN KEY ' . $f[1] . ' REFERENCES ' . $f[0] . '(' . $f[1] . ') ';
        }
        if (isset($opts['nn'])) {
            $this->request .= ' NOT NULL ';
        }
        if (isset($opts['ai'])) {
            $this->request .= ' AUTO_INCREMENT ';
        }

        return $this;
    }

    /**
     *
     */
    function solve(): self
    {
        return $this;
    }
}
