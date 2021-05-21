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
    function callback(?string $colname = null)
    {
        if (null !== $colname)
            $this->request .= ' ADD ' . $colname . ' INT(16) NOT NULL PRIMARY KEY AUTO_INCREMENT ';
    }
}
