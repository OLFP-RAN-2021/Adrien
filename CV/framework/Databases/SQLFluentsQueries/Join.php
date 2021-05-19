<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

class Join extends AbstractCmd
{
    static $selcall = 0;

    const NaturelJoin = 0;
    const InnerJoin = 1;
    const OuterJoin = 2;
    const LeftJoin = 4;
    const RightJoin = 6;
    const EquiJoin = 7;
    const NonEquiJoin = 8;
    const FullOuterJoin = 9;
    const CrossJoin = 10;

    function __construct(Query $parent)
    {
        ++self::$selcall;
        $this->parent = $parent;
    }

    /**
     * 
     * @param string $localid ID of local table
     * @param string $foreignTableId Name of table.id of foreign table.
     * @param int $jointype Self class constant like Join::LeftInnerJoin.
     */
    function callback(string $localid = "id", string $foreignTableId = 'table.id', ?int $jointype = self::LeftJoin)
    {
        // 
        $foreign = explode('.', $foreignTableId);
        $local = [$this->parent->tablename, $localid];
        $localid = implode('.', $local);

        switch ($jointype) {
            case 0;
                $this->request = ' NATURAL JOIN ' . $foreign[0];
                break;
            case 1;
                $this->request = ' INNER JOIN ' . $foreign[0] . ' ON ' . $localid . ' = ' . $foreignTableId;
                break;
            case 2;
                $this->request = ', ' . $foreign[0];
                break;
            case 4;
                $this->request = ' LEFT JOIN ' . $foreign[0] . ' ON ' . $localid . ' = ' . $foreignTableId;
                break;
            case 6;
                $this->request = ' RIGHT JOIN ' . $foreign[0] . ' ON ' . $localid . ' = ' . $foreignTableId;
                break;
            case 7;
                $this->request = ' EQUI JOIN' . $foreign[0] . ' WHERE ' . $localid . ' = ' . $foreignTableId;
                break;
            case 8;
                $this->request = ' NON EQUI JOIN ' . $foreign[0] . ' WHERE ' . $localid . ' = ' . $foreignTableId;;
                break;
            case 9;
                $this->request = ' FULL OUTER JOIN';
                break;
            case 10;
                $this->request = ' CROSS JOIN';
                break;
        }
    }

    /**
     * 
     */
    function solve(): array
    {
        return [];
    }
}
