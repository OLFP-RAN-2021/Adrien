<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\DBExceptions;
use Framework\Databases\Query;
use Framework\Databases\SQL;

class addForeign extends AbstractCmd
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
     */
    function callback(?string $colname = null, ?string $foreign = null, bool $update = false, bool $delete = false)
    {
        if (null !== $colname && null !== $foreign) {
            $f = explode('.', $foreign);
            $this->request .= ' ADD ' . $colname . ' INT(16) NOT NULL AUTO_INCREMENT FOREIGN KEY ' . $f[1] . ' REFERENCES ' . $f[0] . '(' . $f[1] . ') ';
            if ($update)
                $this->request .= ' ON UPDATE CASCADE ';
            if ($delete)
                $this->request .= ' ON DELETE CASCADE ';
        }
        $this->request .= "\n";
    }
}
