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

        if (isset($opts['uk'])) {
            $this->append = ' UNIQUE KEY (' . $opts['name'] . ') ';
        }

        if (isset($opts['pk'])) {
            $this->request .= ' PRIMARY KEY ';
        } else if (isset($opts['fk'])) {
            $f = explode('.', array_shift($opts['fk']));
            $this->append = ' FOREIGN KEY (' . $opts['name'] . ') REFERENCES ' . $f[0] . '(' . $f[1] . ') ';
            $this->append .= implode(' ', $opts['fk']) . ' ';
        }

        if (isset($opts['nn']) && false !== $opts['nn']) {
            $this->request .= ' NOT NULL ';
        }

        if (isset($opts['ai']) && false !== $opts['ai']) {
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
